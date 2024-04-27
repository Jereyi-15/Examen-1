$(document).ready(function() {
    const CELDAS = 9;
    let tablero = ['', '', '', '', '', '', '', '', '']; // Representación del tablero
    let jugadorActual = 'X'; // Jugador actual, empieza con 'X'

    // Función para inicializar el tablero
    function inicializarTablero() {
        const gameBoard = $('#game-board');
        for (let i = 0; i < CELDAS; i++) {
            const cell = $('<div class="cell" id="cell-' + i + '"></div>'); // Agregar la clase .cell
            gameBoard.append(cell);
        }
    }

    // Función para verificar si hay un ganador
    function verificarGanador() {
        const lineasGanadoras = [
            [0, 1, 2], [3, 4, 5], [6, 7, 8], // Filas
            [0, 3, 6], [1, 4, 7], [2, 5, 8], // Columnas
            [0, 4, 8], [2, 4, 6] // Diagonales
        ];

        for (let linea of lineasGanadoras) {
            let [a, b, c] = linea;
            if (tablero[a] !== '' && tablero[a] === tablero[b] && tablero[a] === tablero[c]) {
                $('#result-message').text(`¡Jugador ${jugadorActual} ha ganado!`);
                if (jugadorActual === 'X') {
                    guardarResultado('ganadaTresEnRaya'); // Llamar a la función guardarResultado con el resultado ganada
                } else if (jugadorActual === 'O') {
                    guardarResultado('perdidaTresEnRaya'); // Llamar a la función guardarResultado con el resultado perdida
                }
                return true; // Retorna true si hay un ganador
            }
        }

        if (tablero.every(celda => celda !== '')) {
            $('#result-message').text('¡Empate!');
            guardarResultado('empatadaTresEnRaya'); // Llamar a la función guardarResultado con el resultado empatada
            return true; // Retorna true si hay un empate
        }

        return false; // Retorna false si no hay ganador ni empate
    }


    // Función para cambiar al siguiente jugador
    function cambiarTurno() {
        jugadorActual = jugadorActual === 'X' ? 'O' : 'X'; // Cambia al siguiente jugador
        $('#result-message').text(`Turno del jugador ${jugadorActual}`);
    }

    // Función para reiniciar el juego
    function reiniciarJuego() {
        tablero = ['', '', '', '', '', '', '', '', '']; // Reinicia el tablero
        jugadorActual = 'X'; // Reinicia al jugador actual
        $('.cell').text(''); // Limpiar el contenido de las celdas
        $('#result-message').empty(); // Limpiar el mensaje de resultado
    }

    // Manejar el clic en una celda del tablero
    $('#game-board').on('click', '.cell', function() {
        let index = $(this).index();
        if (tablero[index] === '') {
            // Realizar la jugada
            tablero[index] = jugadorActual; // Asigna el jugador actual a la celda
            $(this).text(jugadorActual); // Actualiza la interfaz
            if (!verificarGanador()) {
                cambiarTurno(); // Cambia al siguiente jugador si no hay ganador
            }
        }
    });

    // Inicializar el tablero al cargar la página
    inicializarTablero();

    // Función para guardar el resultado y recargar la página
    function guardarResultado(resultado) {
        var userId = $('#save-button').data('user-id');
        $.post('procesos/guardar_partida.php', { user_id: userId, resultado: resultado })
            .done(function(data) {
                // Manejar la respuesta si es necesario
                console.log(data);
                alert("¡Partida guardada exitosamente!");
                location.reload(); // Recargar la página después de guardar el resultado
            })
            .fail(function() {
                // Manejar cualquier error
                console.error("Error al intentar guardar la partida");
                alert("Error al intentar guardar la partida. Por favor, inténtalo de nuevo más tarde.");
            });
    }
});


