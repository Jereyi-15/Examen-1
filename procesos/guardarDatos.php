</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="../css/styleIndex.css">
    <title>Guardar Datos</title>
</head>
<body>

<?php
require_once "../php/connect.php";

if(isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['clave'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];

    // Sentencia preparada para insertar datos en la tabla de usuarios
    $query = $mysqli->prepare("INSERT INTO usuarios (Id, Nombre, Apellido, Email, Clave) VALUES (?, ?, ?, ?, ?)");
    $query->bind_param("issss", $id, $nombre, $apellido, $email, $clave);

    // Ejecutar la consulta preparada para registrar al usuario
    if($query->execute()) {
        // Insertar una nueva entrada en la tabla de estadísticas para el usuario recién creado
        $query_insertar_estadisticas = $mysqli->prepare("INSERT INTO estadisticas (Id_usuario, P_Ganadas_tresEnRaya, P_Perdidas_tresEnRaya, P_Empatadas_tresEnRaya, P_Ganadas_cuatroEnLinea, P_Perdidas_cuatroEnLinea, P_Empatadas_cuatroEnLinea, P_Ganadas_ahorcado, P_Perdidas_ahorcado, P_Empatadas_ahorcado) VALUES (?, 0, 0, 0, 0, 0, 0, 0, 0, 0)");
        $query_insertar_estadisticas->bind_param("i", $id);
        
        // Ejecutar la consulta preparada para insertar estadísticas
        if($query_insertar_estadisticas->execute()) {
            echo "<div class='guardado-mensaje'>Datos guardados correctamente. Redireccionando al índex en 3 segundos...</div>";
            header("refresh:3; url=../index.php"); // Redireccionar después de 3 segundos al índex.php
            exit;
        } else {
            echo "<div class='guardado-mensaje'>Error: Ocurrió un error al guardar los datos de estadísticas: </div>" . $mysqli->error;
            header("refresh:3; url=../guardar.php"); // Redireccionar después de 3 segundos al guardar.php
            exit;
        }
    } else {
        echo "<div class='guardado-mensaje'>Error: Ocurrió un error al guardar los datos del usuario: </div>" . $mysqli->error;
        header("refresh:3; url=../guardar.php"); // Redireccionar después de 3 segundos al guardar.php
        exit;
    }
}   
?>


</body>
</html>
