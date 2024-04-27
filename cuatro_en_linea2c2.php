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
   

    <header>
    <div >
    <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if(isset($_SESSION['verificar']) && $_SESSION['verificar']){
                '<span class="user-info">' . $_SESSION['user'] . '</span>';
            }
        ?>
    </div>
    </header>
    
     
    <h1>CUATRO EN LINEA</h1>
    <div id=contenedor>
    <table id="Tablero"></table>
    <button id="save-button" data-user-id="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : 'null'; ?>" onclick="guardarResultado()"></button>
   
    </div>
    <div id="turno">Turno del jugador: Rojo</div>
</body>
</html>
