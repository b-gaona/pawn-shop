<?php

namespace Controllers;

use MVC\Router;
use App\Sucursal;
use App\Cliente;
use App\Producto;
use App\Poliza;

require_once __DIR__ . "../../includes/app.php";

class PageController
{
  //Ventana principal
  public static function index(Router $router)
  {
    $success = null;
    $where = "";
    if (!isset($_SESSION)) {
      session_start();
    }

    if (isset($_GET["suc"]) || isset($_GET["pol"])) { //Dar mensajes del CRUD
      $valor = $_GET["suc"] ?? $_GET["pol"];
      $variable = isset($_GET["suc"]) ? "sucursal" : "póliza";

      switch ($valor) {
        case "1":
          $success = "La {$variable} se ha registrado exitosamente";
          break;
        case "2":
          $success = "La {$variable} se ha eliminado exitosamente";
          break;
        case "3":
          $success = "La {$variable} se ha modificado exitosamente";
          break;
        default:
          header("Location: ./");
      }
    }
    if (isset($_GET["id"])) { //Opcion de eliminar sucursal y pólizas
      $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);

      if ($id) {
        if ($_GET["tipo"] == "sucursal") {
          $sucursal = Sucursal::find($id);
          if ($sucursal->getId()) { //Si es que si existe el id y se puede obtener
            $consulta = $sucursal->eliminar($id);
            if ($consulta) {
              header('Location: ./?suc=2');
            } else {
              header('Location: ./');
            }
          } else {
            header("Location: ./");
          }
        }
        if ($_GET["tipo"] == "poliza") {
          $poliza = Poliza::find($id);
          if ($poliza->getId()) {
            $consumidor = Cliente::find($poliza->getId_customer());
            $titular = Cliente::find($poliza->getId_holder());
            $producto = Producto::find($poliza->getId_product());

            $consumidor->eliminar();
            $titular->eliminar();
            $producto->eliminar();

            if ($poliza->getId_beneficiary() != 1) {
              $beneficiario = Cliente::find($poliza->getId_beneficiary());
              $beneficiario->eliminar();
            }

            $consulta = $poliza->eliminar($id);
            if ($consulta) {
              header('Location: ./?pol=2');
            } else {
              header('Location: ./');
            }
          } else {
            header("Location: ./");
          }
        }
      }
    }
    if (isset($_SESSION["user"])) { //Solo verá los de su sucursal del dia de hoy
      //Obtenemos el id de la sucursal
      $id = $_SESSION["user"];
      $sucursal = Sucursal::find($id);
      $idSucursal = $sucursal->getId();
      $where = "WHERE id_branch_office = '{$idSucursal}' AND DATE(date) = CURDATE() ORDER BY date DESC";
    }
    if (isset($_SESSION["admin"])) { //Verá todos los registros del dia de hoy
      $where = " WHERE DATE(date) = CURDATE() ORDER BY date DESC";
    }
    if (isset($_GET["all"]) && $_GET["all"]) { //Si escogieron ver todas las pólizas
      if (isset($_SESSION["user"])) {
        $where = "WHERE id_branch_office = '{$idSucursal}' ORDER BY date DESC";
      } else {
        $where = "ORDER BY date DESC";
      }
    }
    $sucursales = Sucursal::all();
    $polizas = Poliza::all($where);

    $router->render("pages/index", [
      "success" => $success,
      "sucursales" => $sucursales,
      "polizas" => $polizas
    ]);
  }

  //Ventana de error
  public static function error(Router $router)
  {
    $router->render("pages/error", []);
  }

  //Ventana de pdf
  public static function pdf(Router $router)
  {
    extract($_GET);

    $sucursal = Sucursal::find($sucid);
    $consumidor = Cliente::find($consid);
    $titular = Cliente::find($titid);
    $beneficiario = Cliente::find($benid);
    $producto = Producto::find($prodid);
    $poliza = Poliza::find($polid);

    $router->render("pages/polizapdf", [
      "sucursal" => $sucursal,
      "consumidor" => $consumidor,
      "titular" => $titular,
      "beneficiario" => $beneficiario,
      "producto" => $producto,
      "poliza" => $poliza
    ]);
  }
}
