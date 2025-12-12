<?php
session_start(); //Iniciar sesión
require 'conexion_ventas.php';
$nombre = "";
$telefono= "";
$direccion = "";
$pedido = "";
$id = null;

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
        die("ID inválido.");
    }

    $stmt = $conn->prepare("SELECT nombre,telefono,direccion,pedido FROM cliente WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nombre = htmlspecialchars($row['nombre']);
        $telefono = htmlspecialchars($row['telefono']);
        $direccion = htmlspecialchars($row['direccion']);
        $pedido= htmlspecialchars($row['pedido']);
    } else {
        die(" cliente nose encuentra.");
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar registro</title>
  <style>
    body { font-family: sans-serif; background: #f0f2f5; padding: 20px; }
    .formulario { max-width: 500px; margin: auto; background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    .formulario input[type="text"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    .formulario button {
        background-color: #1f252eff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
    }
    .formulario button:hover {
        background-color: #2563eb;
    }


    .alert {
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 6px;
        font-weight: bold;
    }
    .alert-success { background-color: #d4edda; color: #155724; }
    .alert-error   { background-color: #f8d7da; color: #721c24; }
    .alert-info    { background-color: #d1ecf1; color: #0c5460; }
    .alert-warning { background-color: #fff3cd; color: #856404; }
  </style>
</head>
<body>
  <div class="formulario">
    <h2>Editar</h2>
    <form id="formulario" method="POST">
      <input type="text" name="nombre" value="<?= $nombre ?>" required><br>
      <input type="text" name="telefono" value="<?= $telefono ?>" required><br>
      <input type="text" name="direccion" value="<?= $direccion ?>"><br>
      <input type="text" name="pedido" value="<?= $pedido ?>"><br>
      
      <input type="hidden" name="id" value="<?= $id ?>">

      <button type="button" id="btnEnviar">Actualizar</button>
      <button type="button" id="btnEliminar">Eliminar</button>
    </form>
  </div>
  <script>
    function enviarFormulario(accion) {
      const form = document.getElementById("formulario");
      form.action = accion;
      form.submit();
    }

    document.getElementById("btnEnviar").addEventListener("click", function() {
      enviarFormulario("actualizar_cliente.php");
    });

    document.getElementById("btnEliminar").addEventListener("click", function() {
      if (confirm("seguro de que deseas eliminar este registro")) {
        enviarFormulario("eliminar_registro.php");
      }
    });
  </script>
</body>
</html>