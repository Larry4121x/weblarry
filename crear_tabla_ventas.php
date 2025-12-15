<?php
session_start();
include 'conexion_ventas.php';

// Definir la consulta SQL
$sql = "CREATE TABLE IF NOT EXISTS cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(100) NOT NULL UNIQUE,
    direccion VARCHAR(100) NOT NULL,
    pedido VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql) === TRUE) {
    $mensaje = "La tabla se creo o ya existe .";
    $color = "#d4edda"; // verde claro
    $textoColor = "#155724";
} else {
    $mensaje = " Error al crear la tabla: " . htmlspecialchars($conn->error);
    $color = "#f8d7da"; // rojo claro
    $textoColor = "#721c24";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tabla</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f0f2f5;
            display: flex; justify-content: center; align-items: center;
            height: 100vh; margin: 0; padding: 20px; box-sizing: border-box;
        }
        .card {
            background: white; padding: 30px; border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1); text-align: center;
            max-width: 520px; width: 100%;
        }
        .card h2 { margin-top: 0; color: #1e293b; }
        .mensaje { padding: 15px; border-radius: 8px; margin: 20px 0; font-weight: 500; }
        a {
            display: inline-block; margin-top: 20px; padding: 10px 20px;
            background-color: #404753; color: white; text-decoration: none;
            border-radius: 6px; font-weight: bold; transition: background-color 0.2s;
        }
        a:hover { background-color: #2563eb; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Inicialización de base de datos</h2>
        <div class="mensaje" style="background-color: <?= $color ?>; color: <?= $textoColor ?>;">
            <?= $mensaje ?>
        </div>
        <a href="contacto.php">← Ir a contacto</a>
    </div>
</body>
</html>
