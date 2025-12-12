<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Contacto | Pedidos y Envíos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header class="header">
        <nav class="navbar container" aria-label="Menú principal">
            <a href="index.php" class="logo"><span>El Quesillo Nica</span></a>
            <div>
                <ul class="nav-menu">
                    <li><a href="web.php" class="btn-primary">Inicio</a></li>
                    <li><a href="producto.php" class="btn-primary">Productos</a></li>
                    <li><a href="contacto.php" class="btn-primary">Contacto</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <section>
            <h1>Haz tu pedido hoy mismo</h1>
            <p style="text-align:center; font-size:1.2rem;">
                Envíos a Managua, León, Masaya, Granada y todo el país<br>
                <strong>WhatsApp: +505 8765-4321</strong>
            </p>
            <form method="POST" action="subir_datos_ventas.php">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>

                <label for="telefono">telefono:</label>
                <input type="text" name="telefono" id="telefono" required>

                <label for="direccion">direccion:</label>
                <input type="text" name="direccion" id="direccion">

                <label for="pedido"> dime cual es tu pedido:</label>
                <input type="text" name="pedido" id="pedido">

                <input type="submit" value="enviar">
            </form>
            <?php if (isset($_GET['ok']) && $_GET['ok'] === '1'): ?>
                <div style="margin-top:12px; padding:10px; border-radius:8px; background:#d4edda; color:#155724;">
                    ¡Pedido enviado correctamente!
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <div style="margin-top:12px; padding:10px; border-radius:8px; background:#f8d7da; color:#721c24;">
                    Ocurrió un error: <?= htmlspecialchars($_GET['error']) ?>
                    <?php if (isset($_GET['detalle'])): ?>
                        <br><small><?= htmlspecialchars($_GET['detalle']) ?></small>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>© 2025 Quesillos y Refrescos Nicaragüenses | Hecho con amor en la cuna del quesillo</p>
        <a href="https://wa.me/505XXXXXXXX" target="_blank" class="btn-primary btn-whatsapp">
            Pedir por WhatsApp
        </a>
    </footer>

    <script src="js/script.js"></script>
</body>