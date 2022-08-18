<?php


namespace MVC\controllers;


use MVC\core\helpers;
use MVC\models\group;
use MVC\models\privileges as privilegesModel;
use MVC\models\groupPrivileges;

class userGroups extends controller
{
  public $privilegeModel;
  public $groupPrivilegesModel;
  public $groupId;

  public function __construct(){
    parent::__construct();

    $this->viewFolderName = "UserGroups";
    $this->model = new group();
    $this->privilegeModel = new privilegesModel();
  }

  public function main()
  {
    if (empty($_SESSION))
      helpers::reDirect("admin");

    $this->data['groups'] = $this->model->fetchRecords();
    $this->pageTitle = 'Groups';
    $this->method = "main";
    $this->view();
  }

  /**
   * @return integer : Id of the inserted group
   */
  private function addGroup(){
    $this->model->Name = $this->sanitizeString($_POST['groupName']);
    $this->model->add();
    return $this->model->getLastInsertedId();
  }

  /**
   * To check whether the user changed the value of input from HTML inspect
   * @return boolean
   */
  private function checkboxesValidation(){
    $size = count($_POST['privileges']);
    $statusFlag = true;
    for ($i = 0; $i < $size; $i++)
    {
      $_POST['privileges'][$i] = filter_var($_POST['privileges'][$i], FILTER_SANITIZE_NUMBER_INT);
      if (empty($_POST['privileges'][$i]))
      {
        array_splice($_POST['privileges'], $i, 1);
        $i--;
        $size--;
        $statusFlag = false;
      }
    }
    return $statusFlag;
}

  private function addPrivileges($privilegesIds){
    $this->groupPrivilegesModel->groupId = $this->groupId;
    $statusFlag = true;
    foreach($privilegesIds as $id){
      $this->groupPrivilegesModel->privilegeId = $id;
      if (! $this->groupPrivilegesModel->add())
        $statusFlag = false;
    }
    return $statusFlag;
  }

  private function arePrivilegesAddedSuccessfully(){
    $firstCondition  = $this->checkBoxesValidation();
    $secondCondition = $this->addPrivileges($_POST['privileges']);

    return $firstCondition && $secondCondition;
}

  public function add(){

    if (isset($_POST['submit'])) {

    $this->groupId = $this->addGroup();

      if (isset($_POST['privileges']))
      {
        $this->groupPrivilegesModel = new groupPrivileges();

        if (! $this->arePrivilegesAddedSuccessfully())
        {
          $this->addMessageToUser("warning", "Failed to add some privileges, you are redirected to edit this group.");
          // view edit page to let the user edit the privileges that have not been added
          $this->parameters[0] = $this->groupId;
          $this->view();
          return;
        }
      }

      $this->addMessageToUser('success', "Group has been added successfully.");
    }

    $this->pageTitle = "Add Group";
    $this->data['privileges'] = $this->privilegeModel->fetchRecords();
    $this->view();
    unset($this->massegesToUser);
  }

  private function checkIdValidity(){
    if (!isset($this->parameters[0]))
      $this->redirectToHomePage();

    $this->model->id = filter_var($this->parameters[0], FILTER_SANITIZE_NUMBER_INT);

    if (empty($this->model->id))
      $this->redirectToHomePage();
  }

  private function fetchGroupData(){

    $this->checkIdValidity();
    $this->model->id = filter_var($this->parameters[0], FILTER_SANITIZE_NUMBER_INT);
    $this->data['currentGroup'] = $this->model->fetchRecord();
    if (! $this->data['currentGroup'])
      $this->redirectToHomePage();
  }

  private function fetchOldPrivileges(){
    $this->data['allPrivileges'] =  $this->privilegeModel->fetchRecords();

    $this->groupPrivilegesModel = new groupPrivileges();
    $this->groupPrivilegesModel->groupId = $this->data['currentGroup']->id;
    $this->data['storedPrivileges'] = $this->groupPrivilegesModel->getPrivilegesByGroupId();
    $this->data['currentGroupIds'] = [];    // current group privileges' Id
    foreach ($this->data['storedPrivileges'] as $privilege)
      $this->data['currentGroupIds'][] = $privilege->privillege_id;
  }

  private function editGroupName(){
    $this->model->Name = $this->sanitizeString($_POST['groupName']);
    if ($this->model->Name !== $this->data['currentGroup']->name) // check if the group name is modified or not
    {
      $this->model->id = $this->data['currentGroup']->id;
      $this->model->edit();
    }
  }

  private function removePrivileges(){
    $privilegesToBeRemoved  = array_diff($this->data['currentGroupIds'], $_POST['privileges']);

    $this->groupPrivilegesModel->groupId = $this->data['currentGroup']->id;
    foreach ($privilegesToBeRemoved as $privilegeId)
    {
      $this->groupPrivilegesModel->privilegeId = $privilegeId;
      $this->groupPrivilegesModel->deleteGroupPrivilege();
    }
  }

  private function addNewModifiedPrivileges(){
    $privilegesToBeInserted = array_diff($_POST['privileges'], $this->data['currentGroupIds']);
    foreach ($privilegesToBeInserted as $privilegeId)
    {
      $this->groupPrivilegesModel->privilegeId = $privilegeId;
      $this->groupPrivilegesModel->add();
    }
  }

  public function edit(){

    $this->fetchGroupData();
    $this->fetchOldPrivileges();

    if (isset($_POST['submit'])) {

      if (isset($_POST['privileges']))
      {
        if (! $this->checkboxesValidation())
        {
          $this->addMessageToUser("error", "Something wrong has happened while modifying privileges, try again.");
          helpers::reDirect("userGroups/edit/{$this->groupId}");
          return;
        }

        // remove the unwanted privileges
        $this->removePrivileges();

        // add the new selected privileges
        $this->addNewModifiedPrivileges();
      }

      $this->editGroupName();
      $this->addMessageToUser('success', "Group is Modified successfully.");
      $this->redirectToHomePage();
    }

    $this->pageTitle = "Edit Group";
    $this->view();
  }

  public function delete(){
    $this->model->id = filter_var($this->parameters[0], FILTER_SANITIZE_NUMBER_INT);

    if($this->model->deleteByPK())
      $this->addMessageToUser('success', "Group has been removed successfully.");
    else
      $this->addMessageToUser('errors', "Failed to remove this group.");

    $this->main();
//    header("refresh:5;url=test.php"); //todo-me: uncomment this and search for the error
  }
}