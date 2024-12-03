<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

include 'db.php';

// Obtener los datos del usuario desde la base de datos
$stmt = $pdo->prepare("SELECT nombre, email, direccion, telefono, Ntarjeta FROM usuarios WHERE email = ?");
$stmt->execute([$_SESSION['usuario']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Error: Usuario no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<header>
<?php include 'header.php'; ?>
</header>
<body class="body-ajustado">
    <div class="contenido contenido-usuario">
        <div  class="user-div">
            <h1 class="">Perfil de <?= htmlspecialchars($usuario['nombre']); ?></h1>
            <p class="">Bienvenido/a, <?= htmlspecialchars($usuario['nombre']); ?>. Aquí puedes ver tu información de perfil.</p>
        </div>

        <div class="user-div">
            <h2>Datos personales</h2>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario['nombre']); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']); ?></p>
        </div>

        <div class="user-div">
            <h2>Información de contacto</h2>
            <p><strong>Dirección:</strong> <?= htmlspecialchars($usuario['direccion'] ?? "No especificada"); ?></p>
            <p><strong>Teléfono:</strong> <?= htmlspecialchars($usuario['telefono'] ?? "No especificado"); ?></p>
        </div>

        <div class="user-div">
            <h2>Método de pago</h2>
            <p><strong>Número de Tarjeta:</strong> <?= $usuario['Ntarjeta'] ? "**** **** **** " . substr($usuario['Ntarjeta'], -4) : "No especificado"; ?></p>
        </div>

        <div class="user-div-enlaces">
            <a href="editar_usuario.php">Editar perfil</a>
            <a href="logout.php">Cerrar sesión</a>
        </div>

    </div>
</body>
<footer>
<?php include 'footer.php'; ?>
</footer>
</html>
