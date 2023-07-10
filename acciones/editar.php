<?php
    $id=$_POST['id'];
    #Captura de datos
    $nombre=$_POST['nombreArchivo'];
    $archivo=$_FILES['archivo'];
    //var_dump($archivo);

    include '../config/bd.php';
    $conexion=conexion();
    $datos=datos($conexion, $id);
    $nombreA=$datos['nombre'];

    if(($archivo['size']==0 && $nombre=='') || ($archivo['size']==0 && $nombre==$nombreA)){ #No se modifico el archivo
      header("location:../editar.php?id=$id");
    }

    if(($archivo['size']==0 && $nombre!='') || ($archivo['size']==0 && $nombre!=$nombreA)){ #Se modifico el archivo
      #Solo el nombre
      $query = editarNombre($conexion, $id, $nombre);
      header("location:../editar.php?id=$id&&editar=success");

    }

    #Categoria y tipo
    $tipo=$archivo['type'];
    $categoria=explode('.',$archivo['name'])[1];
    //var_dump($categoria);

    #Fecha
    $fecha=date('Y-m-d H:i:s');

    $tmp_name=$archivo['tmp_name'];
    $contenido_archivo=file_get_contents($tmp_name);
    $archivoBLOB=addslashes($contenido_archivo);
    // echo $archivoBLOB;

    if(($archivo['size']>0 && $nombre!='') || ($archivo['size']>0 && $nombre==$nombreA)){
      #Modificar solo archivo
      $query=editarArchivo($conexion,$id,$categoria,$tipo,$fecha,$archivoBLOB);
      header("location:../editar.php?id=$id&&editar=success");
    }

    if(($archivo['size']>0 && $nombre!='') || ($archivo['size']>0 && $nombre==$nombreA)){
      #Modificar todo
      $query=editar($conexion,$id,$nombre,$categoria,$tipo,$fecha,$archivoBLOB);
      header("location:../editar.php?id=$id&&editar=success");
    }


    ?>