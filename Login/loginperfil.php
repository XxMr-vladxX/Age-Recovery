<?php
 // Iniciar la sesión

include('conexion.php');
$conn = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correoElectronico'];
    $contrasena = $_POST['contrasena'];

    // Verificar si las credenciales son correctas
    $query = "SELECT * FROM pacientes WHERE CorreoElectronico = '$correo' AND contrasena = '$contrasena'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        // Si el usuario existe, guardar su id en la sesión
        $row = mysqli_fetch_array($result);
        if(session_start()){
            session_destroy();
        }
        session_start();
        $_SESSION['IdPaciente'] = $row['IdPaciente'];
        $_SESSION['nombre'] = $row['nombre'];

        header("Location: perfilpaciente.php"); // Redirigir al perfil del paciente
        exit();
    } else {
        echo "Credenciales incorrectas";
    }
}
?>

<form method="POST">
    <label for="correoElectronico">Correo Electrónico</label>
    <input type="email" name="correoElectronico" required>

    <label for="contrasena">Contraseña</label>
    <input type="password" name="contrasena" required>

    <input type="submit" value="Iniciar Sesión">
</form>