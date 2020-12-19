<?php
require_once('./class/db.php');
require_once('./class/Controller.php');
class Auth extends Controller{
  public function __construct(){
    $this->DB = new Conexion_DB();
  }
  public function register($id){
    $minutos = intval(date("i"))+60;
    $expirate = intval(date("YmdH").'00') + number_format(($minutos/60), 2, '', '');
    $id_unique = uniqid();
    $string_query = "INSERT INTO token (token,usuario_id,expirate) VALUES ('".$id_unique."','".$id."','".$expirate."')";
    $result_query = $this->DB->QuerySQL($string_query);
    return  $id_unique;
  }
  public function validation_token($token){
    $string_query = "SELECT * FROM token where token='".$token."'";
    $result_query = $this->DB->QuerySQL($string_query);
    $result = $result_query->fetch_all(MYSQLI_ASSOC)[0];
    $minutos = intval(date("i"))+60;
    $expirate = intval($result['expirate']) + number_format(($minutos/60), 2, '', '');
    $string_query = "UPDATE token set expirate='".$id_unique."' WHERE token = '".$token."'";
    $result_query = $this->DB->QuerySQL($string_query);
    return  $result['usuario_id'];
  }

}