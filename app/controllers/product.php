<?php


namespace MVC\controllers;


use MVC\core\FileUpload;
use MVC\core\helpers;
use MVC\core\Messenger;
use MVC\core\validation;
use MVC\models\product as productModel;
use MVC\models\category;

class product extends controller
{
  public $categoryObject;

  public function __construct($db){
    parent::__construct($db);

    $this->viewFolderName = 'product';
    $this->model = new productModel($db);
    $this->categoryObject = new category($db);
  }

  public function main()
  {
    $this->data['mainData'] = $this->model->fetchModelRecords();
    $this->pageTitle = 'Products';
    $this->method = "main";
    $this->view();
  }

  private function validateChosenGroup(){
//      print_r($_POST);die;
    $selectedCategoryId = filter_var($_POST['selectedCategory'], FILTER_SANITIZE_NUMBER_INT);
    if (empty($selectedCategoryId) || ! is_integer((int)$selectedCategoryId))
    {
      $this->messenger->addMessage("Invalid Chosen Category", Messenger::ERROR_MESSAGE);
      return false;
    }
    else
      $this->model->categoryId = $selectedCategoryId;
    return true;
  }

  private function validateName(){

    $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);

    $result = true;
    if (empty($name))
    {
      $this->messenger->addMessage("Product Name is required.", Messenger::ERROR_MESSAGE);
      $result = false;
    }
    if (! validation::isAlphabetical($name)) {
      $this->messenger->addMessage("Product Name must be only alphabetical.", Messenger::ERROR_MESSAGE);
      $result = false;
    }

    if ($result)
      $this->model->name = $name;

    return $result;
  }

  private function validateData(){

    //    validate Category
    if (! $this->validateChosenGroup())
      return false;

    // validating full name
    if(! $this->validateName() ) return false;

    // validating image
    if (isset($_FILES['image']))
    {
      $UploadedFileName = (new FileUpload($_FILES['image'], $this->messenger))->upload();
      if ($UploadedFileName)
        $this->model->image = $UploadedFileName;
      else return false;
    }

    //validate Price
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT);
    if ((double)$price < 0)
    {
      $this->messenger->addMessage("Invalid Price", Messenger::ERROR_MESSAGE);
      return false;
    }else{
      $this->model->price = $price;
    }
    //validate Quantity
    $quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT);
    if ((int)$price < 0)
    {
      $this->messenger->addMessage("Invalid Quantity", Messenger::ERROR_MESSAGE);
      return false;
    }else{
      $this->model->quantity = $quantity;
    }
    return true;
  }

  public function add(){

    $this->pageTitle = "Add Product";
    $this->data['categories'] = $this->categoryObject->fetchModelRecords();
    if (isset($_POST['submit'])) {

      if(! $this->validateData()){
        $this->view();
        return;
      }
      if($this->model->add())
        $this->messenger->addMessage("Product has been added successfully.");
      else
        $this->messenger->addMessage("Failed to add this product.", Messenger::ERROR_MESSAGE);
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
    $this->pageTitle = "Edit Product";
    $this->data['storedProduct'] = $this->model->fetchRecord();
    $this->data['categories'] = (new category($this->db))->fetchModelRecords();
    $oldImage = helpers::showValue('Image', $this->data['storedProduct']);

    if (isset($_POST['submit']))
    {
      if ($this->validateData())
      {
        $this->removeOldFile(IMAGES_UPLOADS . DIRECTORY_SEPARATOR . $oldImage);
        if ($this->model->edit())
          $this->messenger->addMessage("Product has been successfully modified.");
        else
          $this->messenger->addMessage("Failed.", Messenger::ERROR_MESSAGE);
      }else
        $this->messenger->addMessage("Failed.", Messenger::ERROR_MESSAGE);
    }

    $this->data['storedProduct'] = $this->model->fetchRecord();
    $this->view();
  }

  public function delete(){
    $this->checkIdValidity();

    if($this->model->deleteByPK())
      $this->messenger->addMessage( "Product is Removed successfully.");
    else
      $this->messenger->addMessage("Failed to remove this product.", Messenger::ERROR_MESSAGE);

    helpers::reDirectAfterTime($this->controller, 2);
    $this->main();
  }
}