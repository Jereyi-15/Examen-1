document.addEventListener('DOMContentLoaded', () => {
    const board = document.getElementById('Tablero2');
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
                termino = true;
                alert(`¡Jugador ${jugadorActual} ha ganado!`);
                $.ajax({
                    type: 'POST',
                    url: '../AgregarEstadistica.php',
                    data: { dato: jugadorActual },
                    success: function(response) {
                        console.log('Respuesta del servidor:', response);
                    },
                    error: function() {
                        console.error('Error al enviar datos a PHP');
                    }
                });

            } else {
                jugadorActual = jugadorActual === 1 ? 2 : 1; // Cambiar al siguiente jugador mediante este if raro
                if(jugadorActual===2){maquina(); }
             
            }
            
        }
    }

    crearTablero();

    // Agregar el evento click a todas las celdas del tablero
    board.addEventListener('click', eventoCelda);
    function maquina() {
        if (termino) return;

        let columnaAleatoria;
        let filaSeleccionada;

        do {
            columnaAleatoria = Math.floor(Math.random() * cantidad_columnas);
            filaSeleccionada = getColumnaVacia(columnaAleatoria);
        } while (filaSeleccionada === -1);

        const celdas = board.querySelectorAll(`[data-column="${columnaAleatoria}"]`);
        const nuevaCelda = celdas[filaSeleccionada];

        const color = jugadorActual === 1 ? 'red' : 'blue';
        nuevaCelda.style.backgroundColor = color;
        nuevaCelda.classList.add(`jugador${jugadorActual}`);

        if (checkForWin(columnaAleatoria, filaSeleccionada, jugadorActual)) {
            termino = true;
            alert(`¡La máquina ha ganado!`);
        } else {
            jugadorActual = jugadorActual === 1 ? 2 : 1; // Cambiar al siguiente jugador
        }
    }

   
    
});