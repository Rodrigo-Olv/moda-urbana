<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

include 'db.php';

// Obtener la información actual del usuario
$emailUsuario = $_SESSION['usuario'];
$stmt = $pdo->prepare("SELECT nombre, direccion, telefono, Ntarjeta FROM usuarios WHERE email = ?");
$stmt->execute([$emailUsuario]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $Ntarjeta = $_POST['Ntarjeta'];

    // Actualizar la información del usuario en la base de datos
    $stmt = $pdo->prepare("UPDATE usuarios SET nombre = ?, direccion = ?, telefono = ?, Ntarjeta = ? WHERE email = ?");
    if ($stmt->execute([$nombre, $direccion, $telefono, $Ntarjeta, $emailUsuario])) {
        $mensaje = "Tus datos han sido actualizados exitosamente.";
        // Refrescar los datos del usuario
        $usuario = ['nombre' => $nombre, 'direccion' => $direccion, 'telefono' => $telefono, 'Ntarjeta' => $Ntarjeta];
    } else {
        $mensaje = "Error al actualizar los datos. Por favor, inténtalo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <title>Editar Perfil</title>
</head>
<header>
<?php include 'header.php'; ?>
</header>
<body class="body-ajustado">
    <div class="contenido">
        <h1 class="inicio-sesion">Editar Perfil</h1>
        <?php if (isset($mensaje)) { echo "<p>$mensaje</p>"; } ?>
        <form method="POST" action="" class="formulario-login">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']); ?>" required>
            <br>
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" value="<?= htmlspecialchars($usuario['direccion']); ?>" required>
            <br>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" pattern="\d*" maxlength="15" value="<?= htmlspecialchars($usuario['telefono']); ?>" required>
            <br>
            <label for="Ntarjeta">Número de Tarjeta:</label>
            <input type="number" name="Ntarjeta" min="0" value="<?= htmlspecialchars($usuario['Ntarjeta']); ?>" required>
            <br>
            <input type="submit" value="Guardar Cambios">
        </form>
        <br>
        <a href="usuario.php"><button class="boton-pago">Volver al Perfil</button></a>
    </div>
</body>
<footer>
<?php include 'footer.php'; ?>
</footer>
</html>
