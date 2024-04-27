<?php
session_start();
// Verificar si el usuario está autenticado
if (!isset($_SESSION['verificar']) || !$_SESSION['verificar']) {
    // Si no está autenticado, redirigirlo a la página de inicio de sesión
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tres en Raya</title>
    <link rel="stylesheet" href="css/styleTresEnRaya.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <ul>
            <li><a href="menuTresEnLinea.php">Modo de Juego</a></li>
			<li><a href="seleccionJuego.php">Inicio</a></li>
            <li><a href="logout.php">Cerrar sesión</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h2>Tres en Raya</h2>
    <div id="game-board" class="game-board">
        <!-- El tablero se generará dinámicamente con JavaScript -->
    </div>
    <div id="result-message" class="result-message"></div>
    <button id="reset-button">Reiniciar Juego</button>
    <button id="save-button" data-user-id="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : 'null'; ?>" onclick="guardarResultado()">Guardar Resultado</button>
</div>

<!-- Incluir el archivo JavaScript -->
<script src="js/tres_en_rayaCPU.js"></script>

<!-- Inicializar el tablero al cargar la página -->
<script>
    $(document).ready(function() {
        inicializarTablero();

        // Asociar la función reiniciarJuego al evento de clic del botón "Reiniciar Juego"
        $('#reset-button').on('click', function() {
            reiniciarJuego(); // Llamar a la función reiniciarJuego cuando se hace clic en el botón
        });
    });
</script>

</body>
</html>