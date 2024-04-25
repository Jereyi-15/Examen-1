<?php
session_start();

if (!isset($_SESSION['verificar'])) {
    header("Location:index.php");
    exit;
}

require_once "php/connect.php"; // Incluye el archivo de conexión a la base de datos
$conn = $mysqli= new mysqli("localhost", "root", "", "Examen 1",3306);
if (isset($_POST['jugar'])) {
    
    $jugador2 = $_POST['jugador2']; 

    $sql = "SELECT COUNT(*) AS total FROM usuarios WHERE Id = $jugador2";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        $total = $row['total'];

        // Verificar si el ID del jugador 2 existe en la tabla usuarios
        if ($total == 1) {
            // Redirigir al juego si el jugador 2 es válido
            header("Location: cuatro_en_linea2c2.php");
            exit;
        } else {
            // Almacenar un mensaje de alerta en la sesión si el ID del jugador 2 no fue encontrado
            $_SESSION['alerta'] = "Error: ID de jugador 2 no válido.";
            header("Location:Menu_4_Rayas.php"); 
            exit;
        }
    } else {
        // Almacenar un mensaje de alerta en la sesión si hubo un error en la consulta
        $_SESSION['alerta'] = "Error al ejecutar la consulta.";
        header("Location:Menu_4_Rayas.php"); 
        exit;
    }
} else {
    $_SESSION['alerta'] = "Error: El formulario no fue enviado correctamente.";
    header("Location:Menu_4_Rayas.php"); 
    exit;
}
?>