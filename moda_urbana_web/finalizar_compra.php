<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

include 'db.php';

// Obtener datos del usuario
$emailUsuario = $_SESSION['usuario'];
$stmt = $pdo->prepare("SELECT id, nombre, Ntarjeta, direccion, telefono FROM usuarios WHERE email = ?");
$stmt->execute([$emailUsuario]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);


// Obtener datos del carrito
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
$total = 0;

// Verificar que hay productos en el carrito
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Generar detalles de compra
    $detalleCompra = "";
    foreach ($carrito as $item) {
        $subtotal = $item['precio'] * $item['cantidad'];
        $total += $subtotal;
        $detalleCompra .= "{$item['nombre']} - {$item['cantidad']} x $ {$item['precio']} = $ " . number_format($subtotal, 2) . "\n";
    }

    // Insertar el pedido en la base de datos
    $stmt = $pdo->prepare("INSERT INTO pedidos (usuario_id, total, estado, direccion_envio) VALUES (?, ?, ?, ?)");
    $stmt->execute([$usuario['id'], $total, 'Pendiente', $usuario['direccion']]);

    // Obtener el ID del pedido recién insertado
    $pedido_id = $pdo->lastInsertId();

    // Insertar los detalles del pedido en la tabla pedidos_detalle
    foreach ($carrito as $item) {
        $stmt = $pdo->prepare("INSERT INTO detalle_pedido (pedido_id, producto_id, cantidad, precio) VALUES (?, ?, ?, ?)");
        $stmt->execute([$pedido_id, $item['id'], $item['cantidad'], $item['precio']]);
    }

    // Vaciar el carrito
    unset($_SESSION['carrito']);

    // Mostrar un mensaje de agradecimiento
    echo "<script>
        alert('¡Gracias por tu compra!');
        window.location.href = 'index.php'; // Redirige al inicio
    </script>";
    exit;
} else {
    $mensaje = "No hay productos en el carrito.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Compra</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<header>
<?php include 'header.php'; ?>
</header>
<body class="body-ajustado">
    <div class="contenido">
        <div class="fondo-finalizar" >
            <h1 class="margin-bottom-3">Finalizar Compra</h1>
            <div class="tus-datos">
                <h2 class="titulo-tabla">Tus Datos</h2>
                    <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario['nombre']); ?></p>
                    <p><strong>Dirección:</strong> <?= htmlspecialchars($usuario['direccion']); ?></p>
                    <p><strong>Teléfono:</strong> <?= htmlspecialchars($usuario['telefono']); ?></p>
                    <p><strong>Nº Tarjeta:</strong> <?= htmlspecialchars($usuario['Ntarjeta']); ?></p>
            </div>
 
                <h2 class="titulo-tabla">Productos en tu compra</h2>
                <table class="tabla-fin-compra">
                    <thead class="titulos-fin-compra">
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($carrito as $item): 
                            $subtotal = $item['precio'] * $item['cantidad'];
                            $total += $subtotal;
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($item['nombre']); ?></td>
                                <td>$<?= number_format($item['precio'], 2); ?></td>
                                <td><?= $item['cantidad']; ?></td>
                                <td>$<?= number_format($subtotal, 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <h3 class="total">Total a pagar: <?= number_format($total, 2); ?> €</h3>

                <form method="POST" action="">
                    <button type="submit" class="boton-pago">Finalizar Compra</button>
                </form>

        </div>
    </div>

</body>
<footer>
<?php include 'footer.php'; ?>
</footer>
</html>
