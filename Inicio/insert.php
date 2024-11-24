<?php
include('conexion.php');
$conn = connection(); // Conexión a la base de datos

// Recoger los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$sexo = $_POST['sexo'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$TipoSangre = $_POST['TipoSangre'];
$peso = $_POST['peso'];  // Asegúrate de que el campo 'peso' sea numérico
$estatura = $_POST['estatura']; 
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$enfermedades = $_POST['enfermedades'];
$alergias = $_POST['alergias']; // Asegúrate de que este campo esté presente
$Cirugias_Accidentes = $_POST['cirugias']; // Asegúrate de que este campo esté presente


// Verificar si 'peso' y 'estatura' son válidos
if (!is_numeric($peso) || !is_numeric($estatura)) {
    die("El peso y la estatura deben ser números válidos.");
}

// Consulta SQL para llamar al procedimiento almacenado
$insert = "CALL insertar(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Preparar la consulta
$stmt = mysqli_prepare($conn, $insert);

// Enlazar los parámetros a la consulta (14 parámetros: cadena de tipos 'sssssssssdssss')
mysqli_stmt_bind_param(
    $stmt, 'ssssssssssssss', // 14 parámetros: los tipos deben coincidir
    $nombre, $apellido, $sexo, $fechaNacimiento, $TipoSangre, $peso, 
    $estatura, $direccion, $telefono, $correo, $contraseña, $enfermedades,
    $alergias, $Cirugias_Accidentes 
);

// Ejecutar la consulta
$query = mysqli_stmt_execute($stmt);

// Verificar si la consulta se ejecutó correctamente
if ($query) {
    // Si se insertó correctamente, redirigir a la página de inicio
    header("Location: ../Login/iniciarsesionpaciente.php"); 
} else {
    // Si hubo un error, mostrar el mensaje de error
    echo "Error: " . mysqli_error($conn);
}

// Cerrar la sentencia y la conexión
mysqli_stmt_close($stmt);
mysqli_close($conn);

var_dump($_POST['fechaNacimiento']);


?>
