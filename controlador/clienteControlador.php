<?php

$ruta = parse_url($_SERVER["REQUEST_URI"]);

if (isset($ruta["query"])) {
  if (
    $ruta["query"] == "ctrRegCliente" ||
    $ruta["query"] == "ctrEditCliente" ||
    $ruta["query"] == "ctrEliCliente"
  ) {
    $metodo = $ruta["query"];
    $cliente = new ControladorCliente();
    $cliente->$metodo();
  }
}

class ControladorCliente
{
  static public function ctrInfoClientes()
  {
    $respuesta = ModeloCliente::mdlInfoClientes();
    return $respuesta;
  }

  static public function ctrRegCliente()
  {
    require "../modelo/clienteModelo.php";

    //insertamos los datos de cliente

    $data = array(
      "razon_social_cliente" => $_POST["razon_social"],
      "nit_ci_cliente" => $_POST["nit_ci"],
      "direccion_cliente" => $_POST["direccion"],
      "nombre_cliente" => $_POST["nombre"],
      "telefono_cliente" => $_POST["telefono"],
      "email_cliente" => $_POST["email"]
    );
    var_dump($data);
    $respuesta = ModeloCliente::mdlRegCliente($data);

    echo $respuesta;
  }

  static public function ctrInfoCliente($id)
  {
    $respuesta = ModeloCliente::mdlInfoCliente($id);
    return $respuesta;
  }

  static function ctrEditcliente()
  {
    require "../modelo/clienteModelo.php";

    $data = array(
      "razon_social_cliente" => $_POST["razon_social"],
      "nit_ci_cliente" => $_POST["nit_ci"],
      "direccion_cliente" => $_POST["direccion"],
      "nombre_cliente" => $_POST["nombre"],
      "telefono_cliente" => $_POST["telefono"],
      "email_cliente" => $_POST["email"]
    );
    
    $respuesta = ModeloCliente::mdlEditcliente($data);
    echo $respuesta;
  }

  

  static function ctrEliCliente()
  {
    require "../modelo/ClienteModelo.php";
    $id = $_POST["id"];

    $respuesta = ModeloCliente::mdlEliCliente($id);
    echo $respuesta;
  }

  static function ctrBusCliente(){
    require "../modelo/clienteModelo.php";
    $cliente=$_POST["nitCliente"];

    $respuesta = ModeloCliente::mdlBusCliente($cliente);
    echo json_encode($respuesta);
  }
}
