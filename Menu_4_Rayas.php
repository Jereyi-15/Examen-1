<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Verificar si el usuario está autenticado, si no, redirigirlo a la página de inicio de sesión
if(!isset($_SESSION['verificar'])) {
    header("Location: index.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Escoger Juego</title>
    <link rel="stylesheet" href="css/styleVerificarSegundoJugador.css"> <!-- Enlace al archivo CSS externo -->
</head>
<body>

<nav class="navbar">
    <div class="navbar-left">
        <?php
              if (session_status() === PHP_SESSION_NONE) {
                session_start();
               }
            if(isset($_SESSION['verificar']) && $_SESSION['verificar']){
                echo '<span class="user-info">' . $_SESSION['user'] . '</span>';
            }
        ?>
    </div>
    <div class="navbar-right">
        <ul class="menu">
            <li class="menu-item"><a class="menu-link" href="seleccionJuego.php">Inicio</a></li>
            <li class="menu-item"><a class="menu-link" href="logout.php">Cerrar sesión</a></li>
        </ul>
    </div>
</nav>
    
    <div id="ContenedorModoJuego">
    <li><a class = "active" href="cuatro_en_linea2c2.php"> Jugar con dos jugadores</a></li>
    <li><a class = "active" href="cuatro_en_lineaMaquina.php">Jugar con Maquina</a></li>
    </div>

</body>
</html>

