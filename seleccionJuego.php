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
    <title>Seleccionar Juego</title>
    <link rel="stylesheet" href="css/styleSeleccionarJuego.css"> <!-- Enlazar el archivo CSS -->
</head>
<body>

<nav class="navbar">
    <div class="navbar-left">
        <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
           
            if(isset($_SESSION['verificar']) && $_SESSION['verificar']){
                echo '<span class="user-info">' . $_SESSION['user'] . '</span>';
            }
        ?>
    </div>
    <div class="navbar-right">
        <ul>
			<li><a href="seleccionJuego.php">Inicio</a></li>
            <li><a href="logout.php">Cerrar sesión</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h2>Seleccionar Juego</h2>
    <ul class="games-list">
        <li><a href="gato.php">Tres en Raya (Gato)</a></li>
        <li><a href="Menu_4_Rayas.php" id="link_4_en_linea">Cuatro en Línea</a></li>
        <li><a href="ahorcado.php">Ahorcado</a></li>
    </ul>
</div>
<script src="js/4enlinea.js"></script>
</body>
</html>
