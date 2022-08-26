<?php
function conectarDB(): mysqli
{
  $db = new mysqli('localhost', 'root', 'Guitarrista920', 'bd_prestaprenda');

  if (!$db) {
    header("Location: /404-error.php");
    exit;
  }
  return $db;
}
