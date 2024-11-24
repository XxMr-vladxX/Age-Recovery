<?php
include ('conexion.php');
$conn = connection();
include ('validar.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Recovery Medicos Login</title>
    <link rel="stylesheet" href="loginSytle.css">
</head>
<body>
    <div class="hero">
        <nav>
            <img src="logo.png" class="logo">
            <ul>
                <li> <a href="../../Inicio/inicio.php">Home</a></li>
            </ul>
        </nav>
    </div>
    <div class="formulario">
        <h1>Inicio de Sesion</h1>
        <form method="post">
            <div class="campo">
                <input type="text" name="usuario" required>
                <label>Email</label>
            </div>
            <div class="campo">
                <input type="password" name="contrasena" required>
                <label>Contraseña</label>
            </div>
            <input type="submit" name="button" value="Iniciar">
            <div class="registrarse">
                No tienes cuenta? Crea una! <a href="../../Inicio/nuevo.php">registro</a><br>
                Eres Paciente? <a href="../../Login/iniciarsesionpaciente.php">Inicia Sesion aqui!</a>
            </div>
        </form>
    </div>
</body>
</html>