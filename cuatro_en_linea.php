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
    <script  src="js/4enlinea.js"></script>
</head>
<body>
    <table id="Tablero">
    </table>
    
   
</body>
</html>