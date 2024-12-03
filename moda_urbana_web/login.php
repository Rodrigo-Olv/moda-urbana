<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Verificar usuario en la base de datos
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['usuario'] = $user['email']; 
        header("Location: index.php");
        exit;
    } else {
        echo "Credenciales incorrectas";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <title>Iniciar Sesión</title>
</head>
<header>
<?php
include 'header.php';
?>
</header>
<body class="body-ajustado">
    <div class="contenido contenido-registro">
        <h1 class="margin-bottom-3">Iniciar Sesión</h1>
        <form method="POST" action="" class="formulario-login">
            <div class="div-login-user">
                <div class="div-login-user-label">
                    <label for="email">Email:</label>
                    <input type="email" name="email" required>
                </div>

                <div class="div-login-user-label">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" required>
                </div>
                <div>
                    <input type="submit" value="Iniciar Sesión" id="iniciar"></input>
                </div>
                

            </div>


        </form>
        <p class="">¿No tienes una cuenta? <a href="registro.php" id="registrate-aqui">Regístrate aquí</a></p>
    </div>

    
</body>
<footer>
<?php
include 'footer.php';
?>
</footer>
</html>
