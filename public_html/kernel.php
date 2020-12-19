<?php
error_reporting(0);
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
class kernel{
  private $url;
  public $web = array(
    'catalogo'=> 'CatalogoController',
    'login'=> 'LoginController'
  );
  public function __construct(){
    $this->url = $_GET['options'];
    try{
      if (empty($this->url))
        throw new Exception ('functions.php does not exist');
      if (!file_exists("./class/".$this->web[$this->url].".php"))
        throw new Exception ('functions.php does not exist');
      else
        require_once("./class/".$this->web[$this->url].".php");
    }catch(Exception $e){
      echo json_encode(['error_message'=>'Options is invalid','error_code'=>'404']);
      exit;
    }
  }
  public function run(){
    $get = $_GET;
    $post = $_POST;
    $json = json_decode(file_get_contents('php://input'));
    $obj_class = new $this->web[$this->url]();
    $obj_class->run($get,$post,$json);
  }
}