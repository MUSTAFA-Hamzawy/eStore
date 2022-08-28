<?php


namespace MVC\core;


class FileUpload
{
  private $fileName;
  private $fileType;
  private $fileSize;
  private $errorNumber;
  private $tmpPath;
  private $fileExtension;
  private $allowedExtensions = [
    'jpg', 'jpeg', 'png', 'gif', 'pdf', 'docx', 'doc', 'txt', 'ppt', 'pptx', 'xls', 'xlsx','webp'
  ];

  public function __construct(array $fileInfo){
    if (!is_null($fileInfo))
    {
      $this->fileName    = $fileInfo['name'];
      $this->fileType    = $fileInfo['type'];
      $this->tmpPath     = $fileInfo['tmp_name'];
      $this->fileSize    = $fileInfo['size'];
      $this->errorNumber = $fileInfo['error'];

      $this->prepareFileName($this->fileName);
    }
  }

  private function prepareFileName(){
    $dotPosition = strrpos($this->fileName, '.' );
    $this->fileExtension = strtolower(substr($this->fileName, $dotPosition+1));
    $this->fileName = substr(md5(time()), 0, 25);
  }

  private function isAllowedExtension(){
    return in_array($this->fileExtension, $this->allowedExtensions);
}

  private function isSizeAllowed(){
//    echo MAX_FILE_SIZE;     // todo-me: implement this function
    return true;
  }

  private function isImage(){
    return preg_match('/image/i', $this->fileType);
  }

  private function getFileFullName(){
    return $this->fileName . '.' . $this->fileExtension;
  }

  public function upload(){ //todo-me: see ref for error types of upload file, and refactor this method
//    if ($this->errorNumber != 0)
//    {
      if (!$this->isAllowedExtension()){
        trigger_error("Files of type {$this->fileExtension} are not allowed.", E_USER_WARNING);
      }else if (!$this->isSizeAllowed()){
        trigger_error("File size exceeds the max allowed size.", E_USER_WARNING);
      }else{    //todo-me: check if this folder has write permission or not ? is_writable built in func
          if ($this->isImage())
            move_uploaded_file($this->tmpPath, IMAGES_UPLOADS . DIRECTORY_SEPARATOR . $this->getFileFullName());
          else  // doc type
            move_uploaded_file($this->tmpPath, DOCS_UPLOADS . DIRECTORY_SEPARATOR . $this->getFileFullName());
      }
//    }

      return $this->getFileFullName();
  }


}