<?php

namespace MVC\controllers;


use MVC\core\helpers;
use MVC\core\Messenger;
use MVC\core\validation;
use MVC\models\group;
use MVC\models\privileges as privilegesModel;
use MVC\models\groupPrivileges;

class userGroups extends controller
{
  public $privilegeModel;
  public $groupPrivilegesModel;
  public $groupId;

  public function __construct($db){
    parent::__construct($db);

    $this->viewFolderName = "UserGroups";
    $this->model = new group($db);
    $this->privilegeModel = new privilegesModel($db);
    $this->groupPrivilegesModel = new groupPrivileges($db);
  }

  public function main()
  {
    $this->data['groups'] = $this->model->fetchModelRecords();
    $this->pageTitle = 'Groups';
    $this->method = "main";
    $this->view();
  }

  /**
   * @return integer : Id of the inserted group
   */
  private function addGroup(){
    $this->model->Name = validation::sanitizeString($_POST['groupName']);
    $this->model->add();
    return $this->model->getLastInsertedId();
  }

  /**
   * To check whether the user changed the value of input from HTML inspect
   * @return boolean
   */
  private function checkboxesValidation(){
    $size = count($_POST['privileges']);
    for ($i = 0; $i < $size; $i++)
    {
      $_POST['privileges'][$i] = filter_var($_POST['privileges'][$i], FILTER_SANITIZE_NUMBER_INT);
      if (empty($_POST['privileges'][$i]))
        return false;
    }
    return true;
}

  //TO add privileges that selected by the user
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

  public function add(){

    if (isset($_POST['submit'])) {

      // preparing needed info for view page
      $this->pageTitle = "Add Group";
      $this->data['privileges'] = $this->privilegeModel->fetchModelRecords();

      // Inserting both the group and its privileges to db
      if (isset($_POST['privileges']))
      {
        // Inserting the validity of the checkboxes
        if (! $this->checkBoxesValidation()){
          $this->messenger->addMessage("Failed! something wrong with privileges, try again.", Messenger::ERROR_MESSAGE);
          $this->view();
          return;
        }

        // Inserting the group name
        $this->groupId = $this->addGroup();
        $this->messenger->addMessage("Group has been added successfully.");
        // Inserting the privileges
        if (! $this->addPrivileges($_POST['privileges']))
          $this->messenger->addMessage("Failed to add some privileges, you may need to edit this group.", Messenger::WARNING_MESSAGE);
      }
      $this->view();
    }

    $this->pageTitle = "Add Group";
    $this->data['privileges'] = $this->privilegeModel->fetchModelRecords();
    $this->view();
  }

  // To avoid if anyone from playing in the URL
  private function checkIdValidity(){
    if (!isset($this->parameters[0]))
      $this->redirectToHomePage();

    $this->model->id = filter_var($this->parameters[0], FILTER_SANITIZE_NUMBER_INT);

    if (empty($this->model->id))
      $this->redirectToHomePage();
  }

  private function fetchGroupData(){
    $this->checkIdValidity();
    $this->data['currentGroup'] = $this->model->fetchRecord();
    if (! $this->data['currentGroup'])
      $this->redirectToHomePage();
  }

  private function fetchOldPrivilegesToEdit(){
    $this->data['allPrivileges'] =  $this->privilegeModel->fetchModelRecords();
    $this->groupPrivilegesModel->groupId = $this->data['currentGroup']->id;
    $this->data['storedPrivileges'] = $this->groupPrivilegesModel->getPrivilegesByGroupId();
    $this->data['currentGroupIds'] = [];    // current group privileges' Id
    foreach ($this->data['storedPrivileges'] as $privilege)
      $this->data['currentGroupIds'][] = $privilege->privillege_id;
  }

  private function editGroupName(){
    $this->model->Name = validation::sanitizeString($_POST['groupName']);

    // check if the name was not modified --> which means the user modified anything else
    if ($this->model->Name !== $this->data['currentGroup']->name)
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
    // preparing some needed info
    $this->pageTitle = "Edit Group";
    $this->fetchGroupData();
    $this->fetchOldPrivilegesToEdit();

    // Updating the old data
    if (isset($_POST['submit'])) {

      if (isset($_POST['privileges']))
      {
        if (! $this->checkBoxesValidation()){
          $this->messenger->addMessage("Something wrong has happened while modifying privileges, try again.",
              Messenger::ERROR_MESSAGE);
          $this->view();
          return;
        }

        // remove the unwanted privileges
        $this->removePrivileges();

        // add the new selected privileges
        $this->addNewModifiedPrivileges();
      }
      $this->editGroupName();
      $this->messenger->addMessage("Group has been Modified successfully.");

      // Displaying the new data
      $this->fetchGroupData();
      $this->fetchOldPrivilegesToEdit();
      $this->view($this->groupId);
      return;
    }

    $this->view();
  }

  public function delete(){
    $this->checkIdValidity();

    if($this->model->deleteByPK())
      $this->messenger->addMessage( "Group has been removed successfully.");
    else
      $this->messenger->addMessage( "Failed to remove this group.", Messenger::ERROR_MESSAGE);

    helpers::reDirectAfterTime($this->controller, 2);
    $this->main();
  }
}