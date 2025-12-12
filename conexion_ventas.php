<?php
if (defined('DIRECT_ACCESS') || !isset($_SERVER['SCRIPT_FILENAME'])) {
    
}

// Configuración de la base de datos
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$base_datos = 'ventas_quesillo';

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    error_log("Error de conexión a la base de datos: " . $conn->connect_error);
    die("Error: No se pudo establecer conexión con la base de datos.");
}else{

    echo" conexion exitosa ";
}

$conn->set_charset("utf8mb4");
