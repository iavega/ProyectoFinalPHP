<?php
require_once('./class/db.php');
require_once('./class/Controller.php');
require_once('./class/Auth.php');
class LoginController extends Controller{
  public function __construct(){
    $this->DB = new Conexion_DB();
    $this->Auth = new Auth();
  }
  public function init($get,$post,$json){
    $string_query = "SELECT * FROM usuarios where correo='".$json->email."'";
    $result_query = $this->DB->QuerySQL($string_query);
    $result = $result_query->fetch_all(MYSQLI_ASSOC)[0];
    if ($result['correo'] != $json->email || $result['password'] != $json->pass ){
        echo json_encode(
          [
            "error_message"=>"El usuario o contraseña son incorrectos",
            "error_code"=>"401"
          ]
      );
    }else{
      $id_unico = $this->Auth->register($result['id']);
      echo json_encode(["access_client"=>$id_unico]);
    }
  }
  public function verificar($get,$post,$json){
    $id_unico = $this->Auth->validation_token($json->token);
    echo json_encode(["access_client"=>$json->token,"id"=>$id_unico]);
  }
  public function show($get,$post,$json){
    $string_query = "SELECT * FROM usuarios where id='".$get['id']."'";
    $result_query = $this->DB->QuerySQL($string_query);
    $result = $result_query->fetch_all(MYSQLI_ASSOC)[0];
    if ($result){
      echo json_encode(["data"=>$result]);
    }else{
      echo json_encode(
        [
          "error_message"=>"El usuario es invalido",
          "error_code"=>"401"
        ]);
    }
  }
  public function exit($get,$post,$json){
    $string_query = "DELETE FROM token where token='".$get['token']."'";
    $result_query = $this->DB->QuerySQL($string_query);
      echo json_encode(
        [
          "error_message"=>"La seccion se a cerrado correctamente",
          "error_code"=>"200"
        ]);
  }
  public function run($get,$post,$json){
    switch($get['case']){
      case "init":
        $this->init($get,$post,$json);
        break;
      case "verificar":
          $this->verificar($get,$post,$json);
          break;
      case "show":
            $this->show($get,$post,$json);
            break;
      case "exit":
          $this->exit($get,$post,$json);
          break;
      default:
        $this->default();
        break;
    }
  }
}