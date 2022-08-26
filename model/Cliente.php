<?php

namespace App;

class Cliente extends Main
{
  //Propiedades que se modifican de la clase padre
  protected static $tabla = "client_data";
  protected static $columnasTabla = [
    "id",
    "name",
    "cellphone",
    "address",
    "id_data_client",
  ];

  //Atributos
  public $id;
  public $name;
  public $cellphone;
  public $address;
  public $id_data_client;

  //Constructor
  public function __construct($args = [])
  {
    $this->id = $args["id"] ?? "";
    $this->name = $args["name"] ?? "";
    $this->cellphone = $args["cellphone"] ?? "";
    $this->address = $args["address"] ?? "";
    $this->id_data_client = $args["id_data_client"] ?? "";
  }

  //Metodos unicos de clase
  public function validar()
  {
    $flag = "validated";
    if (!$this->name || !$this->cellphone || !$this->id_data_client || !$this->address) {
      $flag = "Todos los campos son obligatorios";
    }
    return $flag;
  }

  //Setters
  public function setId($id)
  {
    $this->id = $id;
  }
  public function setAddress($address)
  {
    $this->address = $address;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function setCellphone($cellphone)
  {
    $this->cellphone = $cellphone;
  }
  public function setId_data_client($id_data_client)
  {
    $this->id_data_client = $id_data_client;
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
  public function getCellphone()
  {
    return $this->cellphone;
  }
  public function getAddress()
  {
    return $this->address;
  }
  public function getId_data_client()
  {
    return $this->id_data_client;
  }
}
