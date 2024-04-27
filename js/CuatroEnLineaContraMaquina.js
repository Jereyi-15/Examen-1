document.addEventListener('DOMContentLoaded', () => {
    const board = document.getElementById('Tablero2');
    const cantidad_filas = 6;
    const cantidad_columnas = 7;
    let termino = false;
    let jugadorActual = 1;
   
   let turnoDisplay = document.getElementById('turnoDisplay'); 
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
    function actualizarTurnoDisplay() {
        const colorTurno = jugadorActual === 1 ? 'Rojo' : 'Azul';
    
        if (turnoDisplay) {
            turnoDisplay.textContent = `Turno del jugador: ${colorTurno}`;
        } else {
            console.error("Elemento turnoDisplay no encontrado");
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

    function eventoCelda(event) {
        if (termino) return;

        const celdaSeleccionada = event.target;
        const columnaActual = parseInt(celdaSeleccionada.dataset.column);
        const filaSeleccionada = getColumnaVacia(columnaActual);

        if (filaSeleccionada !== -1) {
          
        
            const celdas = board.querySelectorAll(`[data-column="${columnaActual}"]`);
            const nuevaCelda = celdas[filaSeleccionada];

            const color = jugadorActual === 1 ? 'red' : 'blue';
            nuevaCelda.style.backgroundColor = color;
            nuevaCelda.classList.add(`jugador${jugadorActual}`);

            if (checkForWin(columnaActual, filaSeleccionada, jugadorActual)) {
               if(jugadorActual===1){
                termino = true;
                alert(`¡Jugador ${jugadorActual} ha ganado!`);
                guardarResultado('ganada');
               }else{
                termino = true;
                alert(`¡Jugador ${jugadorActual} ha ganado!`);
                guardarResultado('perdida');
               }

            } else {
                if (tableroLleno()) {
                    termino = true;
                    alert("¡El juego terminó en empate!");
                    guardarResultado('empate');
                } else {
                    actualizarTurnoDisplay();
                    jugadorActual = jugadorActual === 1 ? 2 : 1; // Cambiar al siguiente jugador mediante este if raro
                    if(jugadorActual===2){maquina();
                    actualizarTurnoDisplay(); }
                }
                
             
            }
            
        }
    }

    crearTablero();

    // Agregar el evento click a todas las celdas del tablero
    board.addEventListener('click', eventoCelda);
    function maquina() {
        if (termino) return;

        let mejorColumna = -1;
        let mejorPuntaje = -Infinity;
    
        for (let col = 0; col < cantidad_columnas; col++) {
            const filaVacia = getColumnaVacia(col);
            if (filaVacia !== -1) {
                // Simular colocar una ficha en esta columna
                const celdas = board.querySelectorAll(`[data-column="${col}"]`);
                const nuevaCelda = celdas[filaVacia];
                nuevaCelda.classList.add('jugador2');
    
                // Evaluar el tablero resultante utilizando una función heurística
                const puntaje = evaluarTablero();
    
                // Quitar la ficha simulada
                nuevaCelda.classList.remove('jugador2');
    
                // Actualizar el mejor puntaje y la mejor columna
                if (puntaje > mejorPuntaje) {
                    mejorPuntaje = puntaje;
                    mejorColumna = col;
                }
            }
        }
    
        // Colocar la ficha en la mejor columna encontrada
        const filaSeleccionada = getColumnaVacia(mejorColumna);
        const celdas = board.querySelectorAll(`[data-column="${mejorColumna}"]`);
        const nuevaCelda = celdas[filaSeleccionada];
        nuevaCelda.style.backgroundColor = 'blue'; // Aplicar color azul
        nuevaCelda.classList.add('jugador2');
    
        // Verificar si la máquina ganó
        if (checkForWin(mejorColumna, filaSeleccionada, 2)) {
            termino = true;
            alert(`¡La máquina ha ganado!`);
        } else {
            if (tableroLleno()) {
                termino = true;
                alert("¡El juego terminó en empate!");
                guardarResultado('empate');
            } else {
                jugadorActual = 1;
                actualizarTurnoDisplay();
            }
           
        }
    }

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
    function evaluarTablero() {
        let puntajeTotal = 0;
    
        // Evaluar fichas consecutivas para el jugador 1 (rojo)
        puntajeTotal += evaluarFichasConsecutivas(1);
    
        // Evaluar fichas consecutivas para el jugador 2 (azul)
        puntajeTotal -= evaluarFichasConsecutivas(2);
    
        return puntajeTotal;
    }function evaluarFichasConsecutivas(jugador) {
        let puntaje = 0;
        const ClaseJugador = `jugador${jugador}`;
    
        // Horizontalmente
        for (let fila = 0; fila < cantidad_filas; fila++) {
            for (let col = 0; col <= cantidad_columnas - 4; col++) {
                let count = 0;
                for (let k = 0; k < 4; k++) {
                    if (board.rows[fila].cells[col + k].classList.contains(ClaseJugador)) {
                        count++;
                    }
                }
                puntaje += count * count;
            }
        }
    
        // Verticalmente
        for (let col = 0; col < cantidad_columnas; col++) {
            for (let fila = 0; fila <= cantidad_filas - 4; fila++) {
                let count = 0;
                for (let k = 0; k < 4; k++) {
                    if (board.rows[fila + k].cells[col].classList.contains(ClaseJugador)) {
                        count++;
                    }
                }
                puntaje += count * count;
            }
        }
    
      
        for (let fila = 0; fila <= cantidad_filas - 4; fila++) {
            for (let col = 0; col <= cantidad_columnas - 4; col++) {
                let count = 0;
                for (let k = 0; k < 4; k++) {
                    if (board.rows[fila + k].cells[col + k].classList.contains(ClaseJugador)) {
                        count++;
                    }
                }
                puntaje += count * count;
            }
        }
    
        for (let fila = 0; fila <= cantidad_filas - 4; fila++) {
            for (let col = 3; col < cantidad_columnas; col++) {
                let count = 0;
                for (let k = 0; k < 4; k++) {
                    if (board.rows[fila + k].cells[col - k].classList.contains(ClaseJugador)) {
                        count++;
                    }
                }
                puntaje += count * count;
            }
        }
    
        return puntaje;
    }
    function tableroLleno() {
        const celdas = board.querySelectorAll('td');
        for (let celda of celdas) {
            if (!celda.classList.contains('jugador1') && !celda.classList.contains('jugador2')) {
                return false; // Todavía hay celdas vacías, el tablero no está lleno
            }
        }
        // Si llega hasta aquí, todas las celdas están ocupadas
        return true;
    }
    
});
