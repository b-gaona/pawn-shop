<?php

namespace Controllers;

use MVC\Router;
use App\Cliente;
use App\Poliza;
use App\Producto;
use App\Sucursal;

require_once __DIR__ . "../../includes/app.php";

class PolizaController
{
  //Ventana de administrador principal
  public static function index(Router $router)
  {
    if (!isset($_SESSION)) {
      session_start();
    }
    $db = conectarDB();
    $consumidor = null;
    $titular = null;
    $beneficiario = null;
    $producto = null;

    //Para que no entre el administrador a agregar polizas ni el usuario a modificarlas
    if (isset($_SESSION["admin"]) && empty($_GET) || isset($_SESSION["user"]) && !empty($_GET)) {
      header("Location: ./");
    }
    if (isset($_GET["id"])) { //Verificar existencia
      $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);
      //Si el id es un numero (validado en el renglon de arriba)
      if ($id) {
        $poliza = Poliza::find($id);
        $consumidor = Cliente::find($poliza->getId_customer());
        $titular = Cliente::find($poliza->getId_holder());
        $beneficiario = Cliente::find($poliza->getId_beneficiary());
        $producto = Producto::find($poliza->getId_product());
        $sucursal = Sucursal::find($poliza->getId_branch_office());

        if (!$poliza->getId()) { //Si es que si existe el id y se puede obtener
          header("Location: ./");
        }
      } else {
        header("Location: ./");
      }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["admin"])) {
      if (isset($_GET["id"])) { //Opcion de modificar
        $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);
        //Si el id es un numero (validado en el renglon de arriba)
        if ($id) {
          $poliza = Poliza::find($id);
          if ($poliza->getId()) { //Si es que si existe el id y se puede obtener
            //Actualizamos los datos de los clientes y del producto
            extract($_POST);

            $consumidor = Cliente::find($poliza->getId_customer());
            $consumidor->setName($name1 . " " . $lastname1);
            $consumidor->setCellphone($phone1);
            $consumidor->setAddress($address1);

            $titular = Cliente::find($poliza->getId_holder());
            $titular->setName($name2 . " " . $lastname2);
            $titular->setCellphone($phone2);
            $titular->setAddress($address2);

            $beneficiario = Cliente::find($poliza->getId_beneficiary());

            if ($poliza->getId_beneficiary() != 1) { //Si es diferente de N/A
              if ($name3 && $lastname3) {
                $beneficiario->setName($name3 . " " . $lastname3);
                $beneficiario->modificar();
              } else {
                $poliza->setId_beneficiary(1); //Y le asigno el 1 que es el N/A
                $beneficiario->eliminar(); //Elimino el registro
              }
            } else if ($name3 != "N/A" && ($name3 && $lastname3)) { //Es igual a N/A, hay que crear un cliente más SIEMPRE Y CUANDO NO ESTEN VACIOS
              $beneficiario = new Cliente(
                [
                  "name" => $name3 . " " . $lastname3,
                  "cellphone" => " ",
                  "address" => " ",
                  "id_data_client" => "3"
                ]
              );
              $beneficiario->crear();
              $query = "SELECT * FROM client_data WHERE name = '${name3} ${lastname3}' AND id_data_client = '3' ORDER BY id DESC LIMIT 1";
              $resultado = $db->query($query);
              $usuario = $resultado->fetch_assoc();
              $idBeneficiario = $usuario["id"];

              //Hay que cambiar el id del beneficiario a la poliza
              $poliza->setId_beneficiary($idBeneficiario);
            } else {
              $poliza->setId_beneficiary(1);
            }

            $producto = Producto::find($poliza->getId_product());
            $producto->setDescription($description);
            $producto->setLoan_amount($loan_amount);
            $producto->setAppraisal_amount($appraisal_amount);


            $resultado1 = $poliza->modificar();
            $resultado2 = $consumidor->modificar();
            $resultado3 = $titular->modificar();
            $resultado5 = $producto->modificar();

            if ($resultado1 && $resultado2 && $resultado3 && $resultado5) {
              header("Location: ./?pol=3");
            }
          } else {
            header("Location: ./");
          }
        } else {
          header("Location: ./");
        }
      }
    } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user"])) {
      extract($_POST);

      //Obtenemos el id de la sucursal
      $id = $_SESSION["user"];
      $sucursal = Sucursal::find($id);
      $idSucursal = $sucursal->getId();

      //Agregamos el consumidor
      $consumidor = new Cliente(
        [
          "name" => $name1 . " " . $lastname1,
          "cellphone" => $phone1,
          "address" => $address1,
          "id_data_client" => "1"
        ]
      );
      $consumidor->crear();
      $query = "SELECT * FROM client_data WHERE name = '${name1} ${lastname1}' AND cellphone = '${phone1}' AND address = '${address1}' AND id_data_client = '1' ORDER BY id DESC LIMIT 1";
      $resultado = $db->query($query);
      $usuario = $resultado->fetch_assoc();
      $idConsumidor = $usuario["id"];

      //Agregamos el titular
      $titular = new Cliente(
        [
          "name" => $name2 . " " . $lastname2,
          "cellphone" => $phone2,
          "address" => $address2,
          "id_data_client" => "2"
        ]
      );
      $titular->crear();
      $query = "SELECT * FROM client_data WHERE name = '${name2} ${lastname2}' AND cellphone = '${phone2}' AND address = '${address2}' AND id_data_client = '2' ORDER BY id DESC LIMIT 1";
      $resultado = $db->query($query);
      $usuario = $resultado->fetch_assoc();
      $idTitular = $usuario["id"];

      //Agregamos el beneficiario
      $idBeneficiario = 1;
      if ($name3 && $lastname3) {
        $beneficiario = new Cliente(
          [
            "name" => $name3 . " " . $lastname3,
            "cellphone" => " ",
            "address" => " ",
            "id_data_client" => "3"
          ]
        );
        $beneficiario->crear();
        $query = "SELECT * FROM client_data WHERE name = '${name3} ${lastname3}' AND id_data_client = '3' ORDER BY id DESC LIMIT 1";
        $resultado = $db->query($query);
        $usuario = $resultado->fetch_assoc();
        $idBeneficiario = $usuario["id"];
      }

      //Agregamos el producto
      $producto = new Producto(
        [
          "description" => $description,
          "loan_amount" => $loan_amount,
          "appraisal_amount" => $appraisal_amount
        ]
      );
      $producto->crear();
      $query = "SELECT * FROM product WHERE description = '${description}' AND loan_amount = '${loan_amount}' AND appraisal_amount = '${appraisal_amount}'";
      $resultado = $db->query($query);
      $usuario = $resultado->fetch_assoc();
      $idProducto = $usuario["id"];

      $invoice = uniqid("ART-");

      $poliza = new Poliza(
        [
          "invoice" => $invoice,
          "id_customer" => $idConsumidor,
          "id_holder" => $idTitular,
          "id_beneficiary" => $idBeneficiario,
          "id_product" => $idProducto,
          "id_branch_office" => $idSucursal
        ]
      );
      $poliza->crear();
    }

    $router->render("pages/poliza", [
      "consumidor" => $consumidor,
      "titular" => $titular,
      "beneficiario" => $beneficiario,
      "producto" => $producto
    ]);
  }
}
