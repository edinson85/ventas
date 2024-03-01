<?php 
class conexion{
private $usuario="root";
private $clave="test";
private $bd="bd_mvc";
private $puerto="3306";
private $servidor="database_mvc";
public $sql;public $res;public $conector;
public function __Construct(){
$this->conector=new mysqli($this->servidor,$this->usuario,
$this->clave,$this->bd,$this->puerto);
}
}
 ?>
 