
<?php
session_start();
//Verificar si el usuario está autenticado
if (!isset($_SESSION['verificar']) || !$_SESSION['verificar']) {
    // Si no está autenticado, redirigirlo a la página de inicio de sesión
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahorcado</title>
    <link rel="stylesheet" href="css/styleAhorcado.css">
    <script type="text/javascript" src="JS/ahorcado.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">  
    
</head>

<header>
    <nav class="navbar">
        <div class="navbar-left">
            <?php
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

</header>

<body>
<br><br><br>
<h1>Ahorcado</h1>
    <div class="container">
        <div class="izq">
            <canvas id="canvas"></canvas>
        </div>
        <div class="der">
        <div id="wordContainer"></div>
            <div class="usedLettersContainer">
                <div id="usedLetters"></div>
            </div>
        </div>
        
    </div>
    <button id="startButton">START</button>
</body>
</html>