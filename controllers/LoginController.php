<?php

namespace Controllers;

use MVC\Router;

require_once __DIR__ . "../../includes/app.php";

class LoginController
{
  //Ventana de login get
  public static function index(Router $router)
  {
    $router->render("pages/login", []);
  }
  //Ventana de login post
  public static function login(Router $router)
  {
    $db = conectarDB();

    //Autenticar el usuario
    extract($_POST);
    $username = $db->escape_string($username);
    $password = $db->escape_string($password);

    if (!$username || !$password) {
      $flag = "Todos los campos son obligatorios";
    } else {
      //Revisar si el usuario existe
      $query = "SELECT * FROM branch_office WHERE username = '${username}'";
      $resultado = $db->query($query);
      $usuario = $resultado->fetch_assoc();

      if ($usuario) {
        //Revisar si el password es correcto. Es una función de php
        $auth = $password == $usuario["password"] ? true : false;
        if ($auth) {
          //El usuario está autenticado 
          session_start();
          //Llenar el arreglo de la sesión
          if ($usuario["password"] == "admin1234?" && $usuario["username"] == "luis_gurria_admin") {
            $_SESSION["admin"] = $usuario["id"];
          } else {
            $_SESSION["user"] = $usuario["id"];
          }
          $_SESSION["login"] = true;

          header("Location: /public/");
        } else {
          $flag = "El usuario o la contraseña no son compatibles";
        }
      } else {
        $flag = "El usuario o la contraseña no son compatibles";
      }
    }
    
    $router->render("pages/login", [
      "flag" => $flag
    ]);
  }
  //Vemtana cerrar sesion
  public static function logout(Router $router)
  {
    $router->render("pages/cerrar-sesion", []);
  }
}
