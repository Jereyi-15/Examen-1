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

    // Sentencia preparada para insertar datos
    $query = $mysqli->prepare("INSERT INTO usuarios (Id, Nombre, Apellido, Email, Clave) VALUES (?, ?, ?, ?, ?)");
    $query->bind_param("issss", $id, $nombre, $apellido, $email, $clave);

    // Ejecutar la consulta preparada
    if($query->execute()) {
		echo "<div class='guardado-mensaje'>Datos guardados correctamente. Redireccionando al índex en 3 segundos...</div>";
		header("refresh:3; url=../index.php"); 
		exit;
	} else {
		echo "<div class='guardado-mensaje'>Error: Ocurrió un error al guardar los datos: </div>" . $mysqli->error;
		header("refresh:3; url=../guardar.php"); 
		exit;
	}
}	

?>

</body>
</html>
