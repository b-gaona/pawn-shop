<?php

namespace Controllers;

use MVC\Router;
use App\Sucursal;

class SucursalController
{
  //Ventana de administrador principal
  public static function index(Router $router)
  {
    $sucursal = new Sucursal($_POST);
    $flag = null;
    if (!isset($_SESSION)) {
      session_start();
    }
    if (isset($_GET["id"])) { //Verificar existencia
      $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);
      //Si el id es un numero (validado en el renglon de arriba)
      if ($id) {
        $sucursal = Sucursal::find($id);
        if (!$sucursal->getId()) { //Si es que si existe el id y se puede obtener
          header("Location: ./");
        }
      } else {
        header("Location: ./");
      }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $db = conectarDB();
      if (isset($_GET["id"])) { //Opcion de modificar
        $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);
        //Si el id es un numero (validado en el renglon de arriba)
        if ($id) {
          $sucursal = Sucursal::find($id);
          if ($sucursal->getId()) { //Si es que si existe el id y se puede obtener
            $sucursal->setName($_POST["name"]);
            $sucursal->setUsername($_POST["username"]);
            $sucursal->setPassword($_POST["password"]);

            //Validar que no exista ya en la base de datos
            $query = "SELECT * FROM branch_office WHERE username = '{$_POST["username"]}'";
            $resultado = $db->query($query);
            $usuario = $resultado->fetch_assoc();
            if ($usuario) {
              $flag = "Ese nombre de usuario ya existe, intenta con uno diferente";
            } else {
              $resultado = $sucursal->modificar();
              if ($resultado) {
                header("Location: ./?suc=3");
              }
            }
          } else {
            header("Location: ./");
          }
        } else {
          header("Location: ./");
        }
      } else { //Opcion de agregar
        $flag = $sucursal->validar();
        //Validar que no exista ya en la base de datos
        $query = "SELECT * FROM branch_office WHERE username = '{$_POST["username"]}'";
        $resultado = $db->query($query);
        $usuario = $resultado->fetch_assoc();
        if ($usuario) {
          $flag = "Ese nombre de usuario ya existe, intenta con uno diferente";
        } else if ($flag == "validated") {
          $sucursal->crear();
        }
      }
    }
    if (isset($_SESSION["user"])) { //Para que el usuario no acceda
      header("Location: ./");
    }

    $router->render("pages/sucursal", [
      "sucursal" => $sucursal,
      "flag" => $flag
    ]);
  }
}
