<?php
session_start();

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
    <title>Seleccionar Modo</title>
    <link rel="stylesheet" href="css/styleSeleccionarJuego.css"> <!-- Enlazar el archivo CSS -->
</head>
<body>

<nav class="navbar">
    <div class="navbar-left">
        <?php
            session_start();
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
    <h2>Seleccionar Modo de Juego</h2>
    <ul class="games-list">
        <li><a href="tres_en_raya.php">Contra Jugador</a></li>
        <li><a href="tres_en_rayaCPU.php">Contra CPU</a></li>
    </ul>
</div>

<input type="hidden" id="user-id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">

</body>
</html>
