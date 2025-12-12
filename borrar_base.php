<?php
session_start();
include 'notificacion_flash.php'; 
if (!isset($_GET['confirm']) || $_GET['confirm'] !== '1') {
    flash("Acceso denegado. Debes confirmar la acción.", FLASH_ERROR);
    header('Location: index.php');
    exit;
}

include 'conexion_ventas.php';
$conn->query("DROP TABLE IF EXISTS cliente"); 
$sql = "CREATE TABLE cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(100) NOT NULL UNIQUE,
    direccion VARCHAR(100) NOT NULL,
    pedido VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";


if ($conn->query($sql) === TRUE) {
    flash(" Base de datos reiniciada correctamente.", FLASH_SUCCESS);
} else {
    flash("Error al reiniciar la base de datos: " . htmlspecialchars($conn->error), FLASH_ERROR);
}

$conn->close();
header('Location: index.php');
exit;
?>