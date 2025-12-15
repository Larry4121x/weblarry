<?php
session_start();
include 'conexion_ventas.php';

// Validar que los datos
if (
    !isset($_POST['id']) ||
    !isset($_POST['nombre']) ||
    !isset($_POST['telefono'])

) {
    die("Datos incompletos.");
}


$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id <= 0) {
    die("ID inválido.");
}

$nombre = trim($_POST['nombre']);
$telefono = trim($_POST['telefono']);
$direccion = trim($_POST['direccion'] ?? '');
$pedido = trim($_POST['pedido'] ?? '');

if (empty($nombre) || empty($telefono)) {
    die("El nombre y telefono son obligatorios.");
}

// Preparar la consulta
$sql = "UPDATE cliente SET nombre = ?, telefono = ?, direccion = ?, pedido = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la consulta: " . htmlspecialchars($conn->error));
}
$stmt->bind_param('ssssi', $nombre, $telefono, $direccion, $pedido, $id);
if ($stmt->execute()) {
    
    header('Location: http://localhost/weblarry/registro_pedidos.php?mensaje=actualizado');
    exit(); 
} else {
    // Error en la ejecución
    die("Error al actualizar: " . htmlspecialchars($stmt->error));
}

$stmt->close();
$conn->close();
?>