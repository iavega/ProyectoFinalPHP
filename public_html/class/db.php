<?php

class Conexion_DB {
    protected $conexion;
    public $insert_id;
    public function __construct()
    {
        $this->conexion =  new mysqli('db','root','dev','Subastas');
        if ($this->conexion->connect_error) {
            die('Error de Conexión (' . $this->conexion->connect_errno . ') '
                    . $this->conexion->connect_error);
        }
        if (!$this->conexion->set_charset("utf8")) {
          printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
          exit();
        }
    }
    public function QuerySQL($String){
        $res = $this->conexion->query($String);
        $this->insert_id = $this->conexion->insert_id;
        return $res;
    }
    public function close(){
        $this->conexion->close();
    }
}