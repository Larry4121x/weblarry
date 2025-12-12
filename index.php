
<?php
session_start();
include 'conexion_ventas.php';
$sql = "SELECT id, nombre,telefono, direccion, pedido FROM cliente ORDER BY id DESC";
$result = $conn->query($sql);

if ($result === false) {
    error_log("Error al consultar: " . $conn->error);
    $cliente = [];
    $_SESSION['error'] = "No se pudo obtener los registros.";
} else {
    $cliente = $result->fetch_all(MYSQLI_ASSOC);
}

$conn->close();
?>
<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de pedidos</title>
    <style>
        body { font-family: sans-serif; background: #f0f2f5; padding: 20px; }
        .container { max-width: 950px; margin: auto; background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { margin: 0 0 10px; }
        .alerts { margin: 10px 0; }
        .alert { padding: 12px; margin-bottom: 12px; border-radius: 6px; font-weight: 600; }
        .alert-success { background-color: #d4edda; color: #155724; }
        .alert-error   { background-color: #f8d7da; color: #721c24; }
        .alert-info    { background-color: #d1ecf1; color: #0c5460; }
        .alert-warning { background-color: #fff3cd; color: #856404; }

        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8fafc; }
        tr:hover { background: #f1f5f9; }
        .empty { text-align: center; color: #64748b; padding: 30px; }

        .actions a { margin-right: 10px; color: #2563eb; text-decoration: none; font-weight: 600; }
        .actions a:hover { text-decoration: underline; }

        .btn-agregar {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            background-color: #2f415e;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
        .btn-agregar:hover { background-color: #445788; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registro de pedidos</h2>
        <div class="alerts">
            <?php if (!empty($_SESSION['ok'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_SESSION['ok']) ?></div>
                <?php unset($_SESSION['ok']); ?>
            <?php endif; ?>
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        </div>

        <?php if (empty($cliente)): ?>
            <p class="empty">No hay clientes registrados.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Pedido</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cliente as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['id']) ?></td>
                        <td><?= htmlspecialchars($item['nombre']) ?></td>
                        <td><?= htmlspecialchars($item['telefono']) ?></td>
                        <td><?= htmlspecialchars($item['direccion']) ?></td>
                        <td><?= nl2br(htmlspecialchars($item['pedido'])) ?></td>
                        <td class="actions">
                            <a href="editar_registro.php?id=<?= urlencode($item['id']) ?>">Editar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
         <div>
        <ul class="nav-menu">
        <a href="contacto.php" class="my-button"> ir a pedido</a>
        <a href="borrar_base.php?confirm=1" 
           class="my-button"
           onclick="return confirm('Se borrarán TODOS los datos');">
            borrar base  
      </div>
</body>
</html>