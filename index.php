<?php

include 'bd/BD.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $query="select * from productos where id_producto=".$_GET['id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="select * from productos";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $nombre=$_POST['nombre'];
    $referencia=$_POST['referencia'];
    $precio=$_POST['precio'];
    $peso=$_POST['peso'];
    $categoria=$_POST['categoria'];
    $stock=$_POST['stock'];
    $fecha_de_creacion=$_POST['fecha_de_creacion'];
    $query="insert into productos(nombre, referencia, precio,peso,categoria,stock,fecha_de_creacion) values ('$nombre', '$referencia', '$precio','$peso','$categoria','$stock','$fecha_de_creacion')";
    $queryAutoIncrement="select MAX(id_producto) as id_producto from productos";
    $resultado=metodoPost($query, $queryAutoIncrement);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $nombre=$_POST['nombre'];
    $referencia=$_POST['referencia'];
    $precio=$_POST['precio'];
    $peso=$_POST['peso'];
    $categoria=$_POST['categoria'];
    $stock=$_POST['stock'];
    // $fecha_de_creacion=$_POST['fecha_de_creacion'];
    $query="UPDATE productos SET nombre='$nombre', referencia='$referencia', precio='$precio', peso='$peso', categoria='$categoria', stock='$stock' WHERE id_producto='$id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $query="DELETE FROM productos WHERE id_producto='$id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");


?>