<?php
session_start();

if(!isset($_SESSION['verificar'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Juego 4 en linea</title>
    <link rel="stylesheet" href="css/styleCuatroEnLinea.css"> 
    <script  src="js/CuatroEnLinea2Jugadores.js"></script>
</head>
<body>
    
    <h1>CUATRO EN LINEA</h1>
    <div id=contenedor>
    <table id="Tablero">
        
        </table>
       
    </div>
  
    
   
</body>
</html>
