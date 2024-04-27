<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['verificar'])) {
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Juego 4 en linea</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/styleCuatroEnLinea.css"> 
    <script  src="js/CuatroEnLinea2Jugadores.js"></script>
   
</head>
<body>

<nav class="navbar">
    <div class="navbar-left">
        <?php
            session_start();
            if(isset($_SESSION['verificar']) && $_SESSION['verificar']){
                '<span class="user-info">' . $_SESSION['user'] . '</span>';
            }
        ?>
    </div>
    <div class="navbar-right">
        <ul>
            <li><a href="Menu_4_Rayas.php">Modo de Juego</a></li>
			<li><a href="seleccionJuego.php">Inicio</a></li>
            <li><a href="logout.php">Cerrar sesión</a></li>
        </ul>
    </div>
</nav>
    
     
    <h1>CUATRO EN LINEA</h1>
    <div id=contenedor>
    <table id="Tablero"></table>
    <button id="save-button" data-user-id="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : 'null'; ?>" onclick="guardarResultado()"></button>
    <div id="turno">Turno del jugador: Rojo</div>
    </div>
    
</body>
</html>
