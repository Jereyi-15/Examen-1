<?php
/*
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Verificar si el usuario está autenticado, si no, redirigirlo a la página de inicio de sesión
if(!isset($_SESSION['verificar'])) {
    header("Location: index.php");
    exit;
}

*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styleVerificarSegundoJugador.css"> 
    <title>Escoger Juego</title>
</head>
<body>
    
    <div id="ContenedorModoJuego">
    <li><a href="ahorcado2player.php"> Jugar con dos jugadores</a></li>
    <li><a href="ahorcado.php" >Jugar con Maquina</a></li>
    </div>

</body>
</html>