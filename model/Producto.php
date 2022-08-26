<?php

namespace App;

class Producto extends Main
{
  //Propiedades que se modifican de la clase padre
  protected static $tabla = "product";
  protected static $columnasTabla = [
    "id",
    "description",
    "loan_amount",
    "appraisal_amount",
  ];

  //Atributos
  public $id;
  public $description;
  public $loan_amount;
  public $appraisal_amount;

  //Constructor
  public function __construct($args = [])
  {
    $this->id = $args["id"] ?? "";
    $this->description = $args["description"] ?? "";
    $this->loan_amount = $args["loan_amount"] ?? "";
    $this->appraisal_amount = $args["appraisal_amount"] ?? "";
  }

  //Metodos unicos de clase
  public function validar()
  {
    $flag = "validated";
    if (!$this->description || !$this->loan_amount || !$this->appraisal_amount) {
      $flag = "Todos los campos son obligatorios";
    }
    return $flag;
  }

  //Setters
  public function setId($id)
  {
    $this->id = $id;
  }
  public function setAppraisal_amount($appraisal_amount)
  {
    $this->appraisal_amount = $appraisal_amount;
  }
  public function setDescription($description)
  {
    $this->description = $description;
  }
  public function setLoan_amount($loan_amount)
  {
    $this->loan_amount = $loan_amount;
  }
  //Getters
  public function getId()
  {
    return $this->id;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function getLoan_amount()
  {
    return $this->loan_amount;
  }
  public function getAppraisal_amount()
  {
    return $this->appraisal_amount;
  }
}
