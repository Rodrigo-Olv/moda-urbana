<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<header>
<?php
include 'header.php';
?>
</header>
<body  class="body-ajustado">
    <div class="contenido-contacto">
    <h1 class="margin-bottom-3">Contacto</h1>
    <p class="texto-contacto">¿Tienes alguna pregunta, necesitas ayuda o simplemente quieres compartir tus comentarios?  
            En <strong>Moda Urbana</strong>, estamos aquí para ayudarte y asegurarnos de que tengas la mejor experiencia de compra.</p>
    <div>
        <h2 class="h2-contacto">¿Cómo podemos ayudarte?</h2>
        <p class="texto-contacto">
            - <strong>Consultas sobre productos:</strong> Detalles, tallas, colores o disponibilidad. <br>
            - <strong>Pedidos y envíos:</strong> Estado de tu compra, devoluciones o cambios. <br>
            - <strong>Sugerencias y comentarios:</strong> Nos encanta escuchar tus ideas para mejorar.
        </p>
    </div>


    <h2 class="h2-contacto">Nuestros canales de contacto:</h2>
    <p class="texto-contacto">
        📧 <strong>Correo electrónico:</strong> <a href="mailto:soporte@modaurbana.com">soporte@modaurbana.com</a> <br>
         📞 <strong>Teléfono:</strong> +34 123 456 789 <br>
         💬 <strong>WhatsApp:</strong> +34 987 654 321
    </p>

    <h2 class="h2-contacto">Horario de atención al cliente:</h2>
    <p class="texto-contacto">
        Lunes a viernes: 9:00 - 18:00 <br>
        Sábados: 10:00 - 14:00 <br>
        Domingos y festivos: Cerrado
    </p>

    <h2 class="h2-contacto">Visítanos también en redes sociales</h2>
    <p class="texto-contacto">
        Encuentra las últimas tendencias, promociones y novedades en nuestras plataformas: <br>
        - <strong>Instagram:</strong> <a href="https://instagram.com/modaurbana" target="_blank">@modaurbana</a> <br>
        - <strong>Facebook:</strong> <a href="https://facebook.com/modaurbana" target="_blank">Moda Urbana Oficial</a> <br>
        - <strong>Twitter:</strong> <a href="https://twitter.com/modaurbanastore" target="_blank">@modaurbanastore</a>
    </p>
    <h2 class="h2-contacto">Formulario contacto</h2>
    <form action="enviar_contacto.php" method="post" class="formulario-contacto">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label class="margin-top-2"  for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label class="margin-top-2"  for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" required></textarea>

        <button class="margin-top-2" type="submit">Enviar</button>
    </form>

    </div>
</body>
<footer>
<?php
include 'footer.php';
?>
</footer>
</html>
