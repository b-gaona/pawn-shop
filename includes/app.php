<?php

require 'functions.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//Conectarnos a la bd
$db = conectarDB();

use App\Main;

Main::setDB($db);