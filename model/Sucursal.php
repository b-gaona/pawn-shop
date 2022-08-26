<?php

namespace App;

class Sucursal extends Main
{  
  //Propiedades que se modifican de la clase padre
  protected static $tabla = "branch_office";
  protected static $columnasTabla = [
    "id",
    "name",
    "password",
    "username",
    "date"
  ];

  //Atributos
  public $id;
  public $name;
  public $password;
  public $username;
  public $date;

  //Constructor
  public function __construct($args = [])
  {
    $this->id = $args["id"] ?? "";
    $this->name = $args["name"] ?? "";
    $this->password = $args["password"] ?? "";
    $this->username = $args["username"] ?? "";
    $this->date = $args["date"] ?? "";
  }

  //Metodos unicos de clase
  public function validar()
  {
    $flag = "validated";
    if (!$this->name || !$this->password || !$this->username) {
      $flag = "Todos los campos son obligatorios";
    }
    return $flag;
  }

  //Setters
  public function setId($id)
  {
    $this->id = $id;
  }
  public function setUsername($username)
  {
    $this->username = $username;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function setPassword($password)
  {
    $this->password = $password;
  }
  public function setDate($date)
  {
    $this->date = $date;
  }
  //Getters
  public function getId()
  {
    return $this->id;
  }
  public function getName()
  {
    return $this->name;
  }
  public function getPassword()
  {
    return $this->password;
  }
  public function getUsername()
  {
    return $this->username;
  }
  public function getDate()
  {
    return $this->date;
  }
}
