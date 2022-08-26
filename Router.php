<?php

namespace MVC;

class Router
{
  public $rutasGET = [];
  public $rutasPOST = [];

  public function urlGet($url, $funcion)
  {
    $this->rutasGET[$url] = $funcion;
  }
  public function urlPost($url, $funcion)
  {
    $this->rutasPOST[$url] = $funcion;
  }

  public function comprobarRutas()
  {
    $urlActual = $_SERVER["PATH_INFO"] ?? "/";
    $tipoMetodo = $_SERVER["REQUEST_METHOD"];

    if ($tipoMetodo === "GET") {
      $funcion = $this->rutasGET[$urlActual] ?? null;
    } else {
      $funcion = $this->rutasPOST[$urlActual] ?? null;
    }
    if ($funcion) {
      call_user_func($funcion, $this);
    } else { //No encontró la URL 
      header("Location: /public/error");
    }
  }

  //Muestra una vista
  public function render($view, $datos = [])
  {
    foreach ($datos as $key => $value) {
      $$key = $value;
    }
    ob_start(); //Aqui empezamos a guardar datos en memoria
    include_once __DIR__ . "/view/{$view}.php"; //Esto guardamos en memoria
    $contenido = ob_get_clean(); //Aqui le decimos que la variable contenido va a ser igual a todo lo que guardo en memoria el ob
    include_once __DIR__ . "/view/layout.php"; //De este modo inyectamos la vista con header y footer

  }
}
