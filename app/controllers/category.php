<?php


namespace MVC\controllers;


use MVC\core\FileUpload;
use MVC\core\helpers;
use MVC\core\Messenger;
use MVC\core\validation;
use MVC\models\category as categoryModel;

class category extends controller
{

  public function __construct($db){
    parent::__construct($db);

    $this->viewFolderName = 'category';
    $this->model = new categoryModel($db);
  }

  public function main()
  {
    $this->data['mainData'] = $this->model->fetchModelRecords();
    $this->pageTitle = 'Categories';
    $this->method = "main";
    $this->view();
  }

  private function validateName(){

    $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);

    $result = true;
    if (empty($name))
    {
      $this->messenger->addMessage("Category Name is required.", Messenger::ERROR_MESSAGE);
      $result = false;
    }
    if (! validation::isAlphabetical($name)) {
      $this->messenger->addMessage("Category Name must be only alphabetical.", Messenger::ERROR_MESSAGE);
      $result = false;
    }

    if ($result)
      $this->model->name = $name;

    return $result;
  }

  private function validateData(){

    // validating full name
    if(! $this->validateName() ) return false;

    if (isset($_FILES['image']))
    {
      $UploadedFileName = (new FileUpload($_FILES['image'], $this->messenger))->upload();
      if ($UploadedFileName)
        $this->model->image = $UploadedFileName;
      else return false;
    }

    return true;
  }

  public function add(){

    $this->pageTitle = "Add Category";

    if (isset($_POST['submit'])) {

      if(! $this->validateData()){
        $this->view();
        return;
      }
      if($this->model->add())
        $this->messenger->addMessage("Category has been added successfully.");
      else
        $this->messenger->addMessage("Failed to add this category.", Messenger::ERROR_MESSAGE);
    }

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

  private function removeOldFile($filePath)
  {
    if (file_exists($filePath))
      unlink($filePath);
  }

  public function edit(){
    $this->checkIdValidity();
    $this->pageTitle = "Edit Category";
    $this->data['storedCategory'] = $this->model->fetchRecord();
    $oldImage = helpers::showValue('Image', $this->data['storedCategory']);

    if (isset($_POST['submit']))
    {
      if ($this->validateData())
      {
        $this->removeOldFile(IMAGES_UPLOADS . DIRECTORY_SEPARATOR . $oldImage);
        if ($this->model->edit())
          $this->messenger->addMessage("Category has been successfully modified.");
        else
          $this->messenger->addMessage("Failed.", Messenger::ERROR_MESSAGE);
      }else
        $this->messenger->addMessage("Failed.", Messenger::ERROR_MESSAGE);
    }

    $this->data['storedCategory'] = $this->model->fetchRecord();
    $this->view();
  }

  public function delete(){
    $this->checkIdValidity();

    if($this->model->deleteByPK())
      $this->messenger->addMessage( "Category is Removed successfully.");
    else
      $this->messenger->addMessage("Failed to remove this category.", Messenger::ERROR_MESSAGE);

    helpers::reDirectAfterTime($this->controller, 2);
    $this->main();
  }
}