<?php

include '../bd/BD.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $query="select * from ventas where id_venta=".$_GET['id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="select * from ventas";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $id_producto=$_POST['id_producto'];
    $cantidad=$_POST['cantidad'];
    $query="insert into ventas(id_producto, cantidad) values ('$id_producto', '$cantidad')";
    $queryAutoIncrement="select MAX(id_venta) as id_venta from ventas";
    $resultado=metodoPost($query, $queryAutoIncrement);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");

?>