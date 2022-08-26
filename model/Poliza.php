<?php

namespace App;

class Poliza extends Main
{
  //Propiedades que se modifican de la clase padre
  protected static $tabla = "policy";
  protected static $columnasTabla = [
    "id",
    "invoice",
    "date",
    "id_customer",
    "id_holder",
    "id_beneficiary",
    "id_product",
    "id_branch_office"
  ];

  //Atributos
  public $id;
  public $invoice;
  public $date;
  public $id_customer;
  public $id_holder;
  public $id_beneficiary;
  public $id_product;
  public $id_branch_office;

  //Constructor
  public function __construct($args = [])
  {
    $this->id = $args["id"] ?? "";
    $this->invoice = $args["invoice"] ?? "";
    $this->date = $args["date"] ?? "";
    $this->id_customer = $args["id_customer"] ?? "";
    $this->id_holder = $args["id_holder"] ?? "";
    $this->id_beneficiary = $args["id_beneficiary"] ?? "";
    $this->id_product = $args["id_product"] ?? "";
    $this->id_branch_office = $args["id_branch_office"] ?? "";
  }

  //Metodos unicos de clase
  public function validar()
  {
    $flag = "validated";
    if (!$this->invoice || !$this->id_customer || !$this->id_holder || !$this->id_beneficiary || !$this->id_product || !$this->id_branch_office ) {
      $flag = "Todos los campos son obligatorios";
    }
    return $flag;
  }

  //Setters
  public function setId($id)
  {
    $this->id = $id;
  }
  public function setInvoice($invoice)
  {
    $this->invoice = $invoice;
  }
  public function setDate($date)
  {
    $this->date = $date;
  }
  public function setId_customer($id_customer)
  {
    $this->id_customer = $id_customer;
  }
  public function setId_holder($id_holder)
  {
    $this->id_holder = $id_holder;
  }
  public function setId_beneficiary($id_beneficiary)
  {
    $this->id_beneficiary = $id_beneficiary;
  }
  public function setId_product($id_product)
  {
    $this->id_product = $id_product;
  }
  public function setId_branch_office($id_branch_office)
  {
    $this->id_branch_office = $id_branch_office;
  }
  //Getters
  public function getId()
  {
    return $this->id;
  }
  public function getInvoice()
  {
    return $this->invoice;
  }
  public function getDate()
  {
    return $this->date;
  }
  public function getId_customer()
  {
    return $this->id_customer;
  }
  public function getId_holder()
  {
    return $this->id_holder;
  }
  public function getId_beneficiary()
  {
    return $this->id_beneficiary;
  }
  public function getId_product()
  {
    return $this->id_product;
  }
  public function getId_branch_office()
  {
    return $this->id_branch_office;
  }
}
