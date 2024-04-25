<?php
session_start();

if (!isset($_SESSION['verificar'])) {
    header("Location: index.php");
    exit;
}



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Juego 4 en línea</title>
    <link rel="stylesheet" href="css/styleVerificarSegundoJugador.css"> 
</head>
<body>
    <form id="formularioJuego"action="verificar_jugadores.php" method="POST">
        <label>ID SEGUNDO JUGADOR</label>
        <input type="text" name="jugador2" required> 
        <button type="submit" name="jugar">Jugar</button>
    </form>
</body>
</html>