<?php
include ('conexion.php');
$conn = connection();
include ('loginpaciente.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Recovery Login</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>
    <div class="hero">
        <nav>
            <img src="Age.png" class="logo">
            <ul>
                <li> <a href="inicio.php">Inicio</a></li>
                <li> <a href="nuevo.php">Registrarse</a></li>
            </ul>
        </nav>
    </div>
    <div class="formulario">
        <h1>Inicio de Sesión</h1>
        <form method="post">
            <div class="campo">
                <input type="text" name="CorreoElectronico" required>
                <label>Email</label>
            </div>
            <div class="campo">
                <input type="password" name="contrasena" required>
                <label>Contraseña</label>
            </div>
            <input type="submit" name="button" value="Iniciar">
            <div class="registrarse">
                ¿Todavía no tienes una cuenta? <a href="nuevo.php">Regístrate</a><br>
                ¿Eres Médico? <a href="InicioDeSesion.php">Inicia sesión</a>
            </div>
        </form>
    </div>
</body>
</html>
