<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCTIONS_URL', __DIR__ . 'functions.php');

function includeTemplate(string $name)
{
  include TEMPLATES_URL . "/${name}.php";
}
function auth()
{
  if (!isset($_SESSION)) {
    session_start();
  }
  if (!isset($_SESSION["login"]) || !$_SESSION["login"]) {
    header("Location: /public/login");
  }
}

//Escapar el HTML y sanitizarlo, esto es para que no ponga codigo malicioso en el html
function sanitize($html)
{
  return htmlspecialchars($html);
}
