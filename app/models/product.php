<?php


namespace MVC\models;


class product extends model
{

  public $id;
  public $categoryId;
  public $name;
  public $image;
  public $quantity;
  public $price;
  public $barCode;
  public $unit;

  const EMAIL_EXIT_ERROR = -1;

  public function __construct($db)
  {
    parent::__construct($db);
    $this->tableName = "product";
    $this->primaryKey = 'ProductId';
    $this->tableSchema = array( 'CategoryId', 'Name', 'Image', 'Quantity', 'price', 'BarCode');
    $this->barCode = null;    // default;
  }

  public function fetchModelRecords()
  {
    $query = "select product.*, category.Name as categoryName from product inner join category on product.CategoryId = category.CategoryId";
    return $this->db->rows($query);
  }


  public function add(){

    $data = array_combine($this->tableSchema, [
        $this->categoryId, $this->name, $this->image, $this->quantity,
        $this->price, $this->barCode
    ]);
    return $this->db->insert($this->tableName, $data);    // returned value is the last inserted id
  }

  public function edit(){
    $data = array_combine($this->tableSchema, [
        $this->categoryId, $this->name, $this->image, $this->quantity,
        $this->price, $this->barCode
    ]);
    $condition = [$this->primaryKey => $this->id];
    return $this->db->update($this->tableName, $data, $condition);
  }
}