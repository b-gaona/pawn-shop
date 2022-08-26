<?php

use MVC\Router;
use Controllers\LoginController;
use Controllers\PageController;
use Controllers\PolizaController;
use Controllers\SucursalController;

require_once __DIR__ . "/../includes/app.php";

$router = new Router();

//VENTANA DE ADMINISTRADOR
$router->urlGet(
  "/",
  [PageController::class, 'index']
);

//VENTANA DE ERROR
$router->urlGet(
  "/error",
  [PageController::class, 'error']
);

//FORMULARIO SUCURSAL POST Y GET

$router->urlPost(
  "/formulario-sucursal",
  [SucursalController::class, 'index']
);
$router->urlGet(
  "/formulario-sucursal",
  [SucursalController::class, 'index']
);

//FORMULARIO POLIZA POST Y GET

$router->urlPost(
  "/formulario-poliza",
  [PolizaController::class, 'index']
);
$router->urlGet(
  "/formulario-poliza",
  [PolizaController::class, 'index']
);

//POLIZA PDF

$router->urlGet(
  "/poliza-pdf",
  [PageController::class, 'pdf']
);


//LOGIN POST Y GET

//Verifica inicio de sesion
$router->urlPost(
  "/login",
  [LoginController::class, 'login']
);
//Salir de la sesion
$router->urlGet(
  "/cerrar-sesion",
  [LoginController::class, 'logout']
);
//Muestra la pagina
$router->urlGet(
  "/login",
  [LoginController::class, 'index']
);


$router->comprobarRutas();
