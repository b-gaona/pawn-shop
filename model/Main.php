<?php

namespace App;

class Main
{
  //Variables que serán modificadas por las clases hijas
  protected static $tabla = '';
  protected static $columnasTabla = [];

  //Conexion a BD
  private static $db;

  //Definir la conexion a la DB
  public static function setDB($database)
  {
    self::$db = $database;
  }

  //Lista todas las propiedades
  public static function all($limit = "")
  {
    $query = "SELECT * FROM " . static::$tabla . " {$limit}";
    $consulta = self::$db->query($query);
    $resultado = $consulta->fetch_all(MYSQLI_ASSOC);

    //Cambiamos el arreglo de arreglos asociativos a un arreglo de objetos
    $objetos = array_map(function ($element) {
      return new static($element);
    }, $resultado);

    return $objetos;
  }

  //Busca una propiedad en especifico
  public static function find($id)
  {
    $query = "SELECT * FROM " . static::$tabla . "  WHERE id = {$id}";
    $consulta = self::$db->query($query);
    $resultado = $consulta->fetch_assoc();
    $objeto = new static($resultado);
    return $objeto;
  }

  public function crear()
  {
    //Sanitizar los datos
    $atributos = $this->sanitizarDatos();
    extract($atributos);

    //Obtenemos llaves y valores del arreglo
    $llaves = join(", ", array_keys($atributos));
    $valores = "'" . join("','", array_values($atributos)) . "'";

    $query = "INSERT INTO " . static::$tabla . " (" . $llaves . ") VALUES (" . $valores . ")";

    $resultado = self::$db->query($query);

    if ($resultado) {
      //Redireccionamos y utilizamos el query string en la URL
      if (static::$tabla == "branch_office") {
        header("Location: /public/?suc=1");
      } else if (static::$tabla == "policy") {
        header("Location: /public/?pol=1");
      }
    }
  }

  public function modificar()
  {
    //Sanitizar los datos
    $atributos = $this->sanitizarDatos();
    extract($atributos);

    $llaveValor = [];
    foreach ($atributos as $key => $value) {
      if ($key != "invoice") {
        $llaveValor[] = "${key} = '${value}'";
      }
    }
    $llaveValor = join(", ", $llaveValor);
    $query = "UPDATE " . static::$tabla . " SET " . $llaveValor . " WHERE id = '{$this->id}'";

    $resultado = self::$db->query($query);
    return $resultado;
  }

  public function eliminar()
  {
    $query = "DELETE FROM " . static::$tabla . "  WHERE id = '{$this->id}'";
    $resultado = self::$db->query($query);
    return $resultado;
  }

  //Unir las columnas de la BD con los valores del objeto
  public function atributos()
  {
    $atributos = [];
    foreach (static::$columnasTabla as $key => $value) {
      if ($key != 'id' && $key != "date") { //Para que al agregar o modificar no haga el SET o el INSERT con un id como columna
        $atributos[$value] = $this->$value;
      }
    }
    return $atributos;
  }

  //Aqui lo que hacemos es sanitizar los datos, para prevenir y evitar inyeccion SQL, se bloquean caracteres especiales y se escapan los que sean necesarios escapar
  public function sanitizarDatos()
  {
    $atributos = $this->atributos();
    $sanitizado = [];

    foreach ($atributos as $key => $value) {
      if ($key != 'id' && $key != "date") {
        $sanitizado[$key] = self::$db->escape_string($value);
      }
    }
    return $sanitizado;
  }
}
