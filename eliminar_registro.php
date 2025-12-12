<?php
include 'conexion_ventas.php';

// Validar id 
if (!isset($_POST['id']) || !is_numeric($_POST['id']) || $_POST['id'] <= 0) {
    die("ID inválido.");
}

$id = (int)$_POST['id'];
$sql = "DELETE FROM cliente WHERE id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error en la consulta: " . htmlspecialchars($conn->error));
}
$stmt->bind_param('i', $id);
if ($stmt->execute()) {
    header('Location: http://localhost/weblarry/weblarry/registro.php?mensaje=eliminado');
    exit(); 
} else {
    echo "Error al eliminar el registro: " . htmlspecialchars($stmt->error);
}

$stmt->close();
$conn->close();
?>