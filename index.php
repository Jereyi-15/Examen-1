<?php
session_start(); // Iniciar sesión antes de cualquier salida

if(isset($_POST['email']) && isset($_POST['clave'])){
    require_once "php/connect.php";
    require_once "procesos/login.php"; // Aquí se procesará el formulario en login.php
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styleIndex.css">
    <title>Login</title>
</head>
<body>

<section>
    <div class="form-container">
        <div class="form-box">
            <div class="form-value">
                <form action="index.php" method="POST">
                    <h2>Login</h2>
                    <div class="input-box">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="clave" required>
                        <label>Password</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox">Remember Me</label>
                    </div>
                    <button>Login</button>
                    <div class="register">
                        <p>Don't have an account? <a href="guardar.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
        <div class="error">
            <?php
            if(isset($_SESSION['error_message'])) {
                echo $_SESSION['error_message'];
                unset($_SESSION['error_message']);
            }
            ?>
        </div>
    </div>
</section>



<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons"></script>

</body>
</html>
