<!DOCTYPE html>
<html lang="es">
<head>
    <title>Juego 4 en linea Maquina</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/styleCuatroEnLinea.css"> 
    <script  src="js/CuatroEnLineaContraMaquina.js"></script>
    
</head>
<body>
    <h1>CUATRO EN RAYA</h1>
   
     <table id="Tablero2"></table>
     <?php
     if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
     if(isset($_SESSION['verificar']) && $_SESSION['verificar']){
                echo '<span class="user-info">' . $_SESSION['user'] . '</span>';
    }
        ?>
     <button id="save-button" data-user-id="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : 'null'; ?>" onclick="guardarResultado()">Guardar Resultado</button>
    
   


    
</body>

</html>