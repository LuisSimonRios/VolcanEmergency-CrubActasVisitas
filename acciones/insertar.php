<?php

    #Captura de datos
    $nombre=$_POST['nombreArchivo'];
    $archivo=$_FILES['archivo'];
    var_dump($archivo);

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

    include '../config/bd.php';
    $conexion=conexion();
    $query=insertar($conexion,$nombre,$categoria,$fecha,$tipo,$archivoBLOB);
    if($query){
        header('location:../index.php?insertar=success');
    }else{
        header('location:../index.php?insertar=error');
    }

?>