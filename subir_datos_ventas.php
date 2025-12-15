<?php
session_start();
include 'conexion_ventas.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $nombre = trim($_POST['nombre'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $direccion = trim($_POST['direccion'] ?? '');
    $pedido = trim($_POST['pedido'] ?? ''); 
    if (empty($nombre) || empty($telefono)) {
        header('Location: ');
        exit();
    }
    $stmt = $conn->prepare("INSERT INTO cliente (nombre,telefono,direccion,pedido) VALUES (?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Error en la preparación: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssss", $nombre, $telefono, $direccion, $pedido);
    if ($stmt->execute()) {
        
        header('Location:http://localhost/weblarry/contacto.php');
        exit();
    } else {

        die("Error al guardar los datos: " . htmlspecialchars($stmt->error));
    }

    $stmt->close();
} else {
    header('Location:http://localhost/weblarry/registro_pedidos.php');
    exit();
}

$conn->close();
?>