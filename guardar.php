<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styleGuardar.css"> 
    <title>Guardar datos</title>
</head>
<body>

<section>
    <div class="form-box">
        <div class="form-value">
            <form action="procesos/guardarDatos.php" method="POST"> 
                <h2>Register</h2>
				<div class="input-box">
    			<input type="text" name="id" required>
    			<label>Id</label>
				</div>
                <div class="input-box">
                    <input type="text" name="nombre" required> 
                    <label>Nombre</label>
                </div>
                <div class="input-box">
                    <input type="text" name="apellido" required> 
                    <label>Apellido</label>
                </div>
                <div class="input-box">
                    <input type="email" name="email" required> 
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <input type="password" name="clave" required> 
                    <label>Password</label>
                </div>
                <button>Guardar</button>
            </form>
        </div>
    </div>
</section>

</body>
</html>
