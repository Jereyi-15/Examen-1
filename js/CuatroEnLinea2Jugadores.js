document.addEventListener('DOMContentLoaded', () => {
    const board = document.getElementById('Tablero');
    const cantidad_filas = 6;
    const cantidad_columnas = 7;
    let termino = false;
    let jugadorActual = 1;
    function crearTablero() {
        for (let i = 0; i < cantidad_filas; i++) {
            const fila = document.createElement('tr');
            for (let j = 0; j < cantidad_columnas; j++) {
                const columna = document.createElement('td');
                columna.dataset.column = j;
                columna.dataset.row = i;
                fila.appendChild(columna);
            }
            board.appendChild(fila);
        }
    }
    

    function getColumnaVacia(col) {
        const celdas = board.querySelectorAll(`[data-column="${col}"]`);
        for (let i = celdas.length - 1; i >= 0; i--) {
            if (!celdas[i].classList.contains('jugador1') && !celdas[i].classList.contains('jugador2')) {
                return parseInt(celdas[i].dataset.row);
            }
        }
        return -1;
    }
    
    function actualizarTurnoDisplay() {
        const colorTurno = jugadorActual === 1 ? 'Rojo' : 'Azul';
        turnoDisplay.textContent = `Turno del jugador: ${colorTurno}`;
    }

    function checkForWin(columna, fila, jugador) {
        const ClasejugadorActual= `jugador${jugador}`;

        function Verificar4Rayas(NumeroColumna,NumeroFila) {
             count = 1; 
             x = columna + NumeroColumna; 
             y = fila+ NumeroFila; 

            //Verifica si las celdas delante de la casilla le pertenecen al mismo jugador
            while (count < 4 && x >= 0 && x < cantidad_columnas && y >= 0 && y < cantidad_filas &&
                board.rows[y].cells[x].classList.contains(ClasejugadorActual)) {
                count++;
                x += NumeroColumna;
                y += NumeroFila;
            }
            x = columna - NumeroColumna;
            y = fila - NumeroFila;
              //Verifica si las celdas detras de la casilla le pertenecen al mismo jugador
            while (count < 4 && x >= 0 && x < cantidad_columnas && y >= 0 && y < cantidad_filas &&
                board.rows[y].cells[x].classList.contains(ClasejugadorActual)) {
                count++;
                x -= NumeroColumna;
                y -= NumeroFila;
            }

            return count >= 4; 
        }

       
        if (Verificar4Rayas(1, 0) || Verificar4Rayas(0, 1) ||  Verificar4Rayas(1, 1) ||  Verificar4Rayas(-1, 1)) {
            return true; 
        }
      
        return false;
    }


// Función para manejar el evento de clic en una celda
function eventoCelda(event) {
    if (termino) return;

    const celdaSeleccionada = event.target;
    const columnaActual = parseInt(celdaSeleccionada.dataset.column);
    const filaSeleccionada = getColumnaVacia(columnaActual);

    if (filaSeleccionada !== -1) {
        const celdas = board.querySelectorAll(`[data-column="${columnaActual}"]`);
        const nuevaCelda = celdas[filaSeleccionada];

        // Siempre establecer el color de la celda según el jugador actual
        const color = jugadorActual === 1 ? 'red' : 'blue';
        nuevaCelda.style.backgroundColor = color;
        nuevaCelda.classList.add(`jugador${jugadorActual}`);

        celdasLlenas++; // Incrementar el contador de celdas llenas

        if (checkForWin(columnaActual, filaSeleccionada, jugadorActual)) {
            termino = true;
            if (jugadorActual === 1) {
                alert(`¡Jugador ${jugadorActual} ha ganado!`);
                guardarResultado('ganadaCuatroEnLinea');
            } else {
                alert(`¡Jugador ${jugadorActual} ha ganado!`);
                guardarResultado('perdidaCuatroEnLinea');
            }
        } else {
            if (celdasLlenas === totalCeldas) { // Verificar si hay un empate
                termino = true;
                alert('¡Empate!');
                guardarResultado('empatadaCuatroEnLinea');
            } else {
                
                jugadorActual = jugadorActual === 1 ? 2 : 1; // Cambiar al siguiente jugador mediante este if raro
            }
        }
    }
}


    crearTablero();
   
    function guardarResultado(resultado) {
        var userId = $('#save-button').data('user-id');
        console.log(userId);
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
    // Agregar el evento click a todas las celdas del tablero
    board.addEventListener('click', eventoCelda);
    function tableroLleno() {
        const celdas = board.querySelectorAll('td');
        for (let celda of celdas) {
            if (!celda.classList.contains('jugador1') && !celda.classList.contains('jugador2')) {
                return false; // Todavía hay celdas vacías, el tablero no está lleno
            }
        }
        
        return true;
    }
   
});

