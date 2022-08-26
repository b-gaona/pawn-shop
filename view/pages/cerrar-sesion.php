<?php
session_start(); //Se le pone este pq no tiene el encabezado de header que habilita el session start
$_SESSION = [];
header("Location: ./");
