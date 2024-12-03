<?php
session_start();
include 'db.php'; 

// Verificar si el usuario ha iniciado sesión y devolver ID
if (isset($_SESSION['usuario'])) {
    echo json_encode([
        "success" => true,
        "usuario_id" => $_SESSION['usuario']
    ]);
} else {
    // Si la sesión no está activa, devolvemos un mensaje de error
    echo json_encode([
        "success" => false,
        "message" => "No hay sesión activa."
    ]);
}
?>
