<?php
  $id=$_GET['id'];
  include "config/bd.php";
  $conexion = conexion();
  $datos=datos($conexion,$id);


  $tipo=$datos['tipo'];
  $categoria=$datos['categoria'];
  $nombre=$datos['nombre'];
  $archivo=$datos['archivo'];
  $valor_tipo="Content-type:$tipo";
  $valor="Content-Disposition:inline;filename=$nombre.$categoria";
  header($valor_tipo);
  header($valor);
  echo $archivo;
?>