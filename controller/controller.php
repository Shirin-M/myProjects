<?php
use \Psr\Http\Message\RequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;
class controller extends baseController {
  public $app;

  public function __construct() {

  // $this->secret='testisnowdone';

  }

//get the image list
  public function getImageList($request,$response)
  {


    $docid =$this->stringSanitizer($request->getParam('docid'));
    $commonModel=new model();
    $getResult=$commonModel->getImageList($docid);
    return $getResult;

  }

  

}
?>
