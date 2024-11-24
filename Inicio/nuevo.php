<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Recovery - Registro</title>
    <link rel="stylesheet" href="php.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
<div class="hero">
    <nav>
        <img src="Age Recovery.jpg.png" class="logo">
        <ul>
            <li><a href="inicio.php">Inicio</a></li>
            <li><a href="../Login/iniciarsesionpaciente.php">Iniciar sesión</a></li>
        </ul>
    </nav>
    <section id="contacto">
        <div class="formulario">
            <h1>Registro</h1>
            <form method="post" action="insert.php">
                <!-- Primera mitad del formulario -->
                <div class="form-column">
                    <div class="campo">
                        <input type="text" name="nombre" required>
                        <label>Nombre</label>
                    </div>
                    <div class="campo">
                        <input type="text" name="apellido" required>
                        <label>Apellido</label>
                    </div>
                    <div class="campo">
                        <input type="date" name="fechaNacimiento" required>
                        <label></label>
                    </div>
                    <div class="campo">
                        <select name="sexo" required>
                            <option value="" disabled selected></option>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                        </select>
                        <label>Sexo</label>
                    </div>
                    <div class="campo">
                        <select name="TipoSangre" required>
                            <option value="" disabled selected></option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                        <label>Tipo de Sangre</label>
                    </div>
                    <div class="campo">
                        <input type="text" name="peso" step="any" required>
                        <label>Peso (kg)</label>
                    </div>
                    <div class="campo">
                        <input type="text" name="cirugias" required>
                        <label>Cirugías/Accidentes</label>
                    </div>
                </div>

                <!-- Segunda mitad del formulario -->
                <div class="form-column">
                    <div class="campo">
                        <input type="text" name="estatura" step="any" required>
                        <label>Estatura (m)</label>
                    </div>
                    <div class="campo">
                        <input type="text" name="telefono" required>
                        <label>Teléfono</label>
                    </div>
                    <div class="campo">
                        <input type="text" name="direccion" required>
                        <label>Dirección</label>
                    </div>
                    <div class="campo">
                        <input type="email" name="correo" required>
                        <label>Correo Electrónico</label>
                    </div>
                    <div class="campo">
                        <input type="password" name="contraseña" required>
                        <label>Contraseña</label>
                    </div>
                    <div class="campo">
                        <input type="text" name="enfermedades" required>
                        <label>Enfermedades</label>
                    </div>
                    <div class="campo">
                        <input type="text" name="alergias" required>
                        <label>Alergias</label>
                    </div>
                </div>

                <input type="submit" value="Registrar">
                <div class="registrarse">
                    ¿Ya tienes cuenta? <a href="../Login/iniciarsesionpaciente.php">Inicia sesión aquí</a>
                </div>
            </form>
        </div>
    </section>
</div>
<footer>
    <p>&copy; 2024 Consultorio Médico "Age Recovery". Todos los derechos reservados.</p>
</footer>
</body>
</html>
