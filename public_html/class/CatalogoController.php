<?php
require_once('./class/db.php');
require_once('./class/Controller.php');
class CatalogoController extends Controller{
  public function __construct(){
    $this->DB = new Conexion_DB();
  }
  public function show(){
    $string_query = "SELECT * FROM productos;";
    $result_query = $this->DB->QuerySQL($string_query);
    $result = $result_query->fetch_all(MYSQLI_ASSOC);
    echo json_encode($result);
  }
  public function insert($get,$post,$json){
    $string_query = "SELECT * FROM token where token='".$json->token."'";
    $result_query = $this->DB->QuerySQL($string_query);
    $result = $result_query->fetch_all(MYSQLI_ASSOC)[0];
    $string_query = "INSERT INTO productos (id_usuario,producto,descripcion,costo_base,precio_actual) VALUES ('".$result['usuario_id']."','".$json->producto."','".$json->description."','".$json->p_base."','".$json->p_base."')";
    $result_query = $this->DB->QuerySQL($string_query);
    echo json_encode(['register'=> true]);
  }
  public function find($get,$post,$json){
    $string_query = "SELECT * FROM productos where id='".$get['id']."';";
    $result_query = $this->DB->QuerySQL($string_query);
    $result = $result_query->fetch_all(MYSQLI_ASSOC)[0];
    $string_query = "SELECT * FROM pujas left join usuarios on pujas.id_usuarios=usuarios.id
    where id_productos='".$get['id']."';";
    $result_query = $this->DB->QuerySQL($string_query);
    $result1 = $result_query->fetch_all(MYSQLI_ASSOC);
    echo json_encode(["data"=>$result,"pujas"=>$result1]);
  }
  public function pujar($get,$post,$json){
    $string_query = "SELECT * FROM token where token='".$json->token."'";
    $result_query = $this->DB->QuerySQL($string_query);
    $result = $result_query->fetch_all(MYSQLI_ASSOC)[0];
    $string_query = "UPDATE productos set precio_actual='".$json->cantidad."' WHERE id='".$json->id."'";
    $result_query = $this->DB->QuerySQL($string_query);
    $string_query = "INSERT INTO pujas (id_productos,id_usuarios,cantidad) VALUES ('".$json->id."','".$result['usuario_id']."','".$json->cantidad."')";
    $result_query = $this->DB->QuerySQL($string_query);
    echo json_encode(['register'=> true]);
  }
  public function run($get,$post,$json){
    switch($get['case']){
      case "show":
        $this->show($get,$post,$json);
        break;
      case "insert":
        $this->insert($get,$post,$json);
        break;
      case "find":
        $this->find($get,$post,$json);
        break;
      case "pujar":
          $this->pujar($get,$post,$json);
          break;
      default:
        $this->default();
        break;
    }
  }
}