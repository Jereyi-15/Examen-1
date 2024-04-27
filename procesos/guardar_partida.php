<?php
// Función para actualizar las estadísticas del usuario
function actualizarEstadisticas($usuario_id, $resultado, $mysqli) {

    // Actualizar las estadísticas según el resultado de la partida
    switch ($resultado) {
        case 'ganadaTresEnRaya':
            $sql = "UPDATE estadisticas SET P_Ganadas_tresEnRaya = P_Ganadas_tresEnRaya + 1 WHERE Id_usuario = $usuario_id";
            break;
        case 'perdidaTresEnRaya':
            $sql = "UPDATE estadisticas SET P_Perdidas_tresEnRaya = P_Perdidas_tresEnRaya + 1 WHERE Id_usuario = $usuario_id";
            break;
        case 'empatadaTresEnRaya':
            $sql = "UPDATE estadisticas SET P_Empatadas_tresEnRaya = P_Empatadas_tresEnRaya + 1 WHERE Id_usuario = $usuario_id";
            break;
        case 'ganadaCuatroEnLinea':
            $sql = "UPDATE estadisticas SET P_Ganadas_cuatroEnLinea = P_Ganadas_cuatroEnLinea + 1 WHERE Id_usuario = $usuario_id";
            break;
        case 'perdidaCuatroEnLinea':
            $sql = "UPDATE estadisticas SET P_Perdidas_cuatroEnLinea = P_Perdidas_cuatroEnLinea + 1 WHERE Id_usuario = $usuario_id";
            break;
        case 'empatadaCuatroEnLinea':
            $sql = "UPDATE estadisticas SET P_Empatadas_cuatroEnLinea = P_Empatadas_cuatroEnLinea + 1 WHERE Id_usuario = $usuario_id";
            break;
        default:
            // Resultado no válido
            return;
    }

    // Ejecutar la consulta
    if ($mysqli->query($sql) === TRUE) {
        echo $usuario_id;

        echo "Estadísticas actualizadas correctamente";
    } else {
        echo "Error al actualizar las estadísticas: " . $mysqli->error;
    }
}

// Verificar si se recibió el resultado de la partida y el usuario id
if (isset($_POST['resultado']) && isset($_POST['user_id'])) {
    require_once "../php/connect.php"; // Incluir el archivo de conexión

    // Obtener el resultado y el usuario id
    $resultado = $_POST['resultado'];
    $usuario_id = $_POST['user_id'];

    // Llamar a la función para actualizar las estadísticas
    actualizarEstadisticas($usuario_id, $resultado, $mysqli);

    // Cerrar la conexión
    $mysqli->close();
}
?>
