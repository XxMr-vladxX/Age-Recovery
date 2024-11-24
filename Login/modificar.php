<?php
include ('conexion.php');
$conn = connection();

$IdPaciente = $_POST['IdPaciente'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$sexo = $_POST['sexo'];
$TipoDeSangre = $_POST['TipoDeSangre'];
$peso = $_POST['peso'];
$estatura = $_POST['estatura'];
$direccion = $_POST['direccion'];
$CorreoElectronico = $_POST['CorreoElectronico'];
$contrasena = $_POST['contrasena'];
$telefono = $_POST['telefono'];
$enfermedades = $_POST['enfermedades'];
$alergias = $_POST['alergias'];
$Cirugias_Accidentes = $_POST['Cirugias_Accidentes'];

if (empty($IdPaciente) || empty($nombre) || empty($fechaNacimiento)) {
    echo "Algunos campos obligatorios están vacíos.";
    exit;
}

$consultar = "call updatee('$IdPaciente','$nombre','$apellido','$fechaNacimiento','$sexo','$TipoDeSangre','$peso','$estatura',
'$direccion','$CorreoElectronico','$contrasena','$telefono','$enfermedades','$alergias','$Cirugías_Accidentes')";

$query = mysqli_query($conn, $consultar);
if ($query) {
    Header("Location: perfilpaciente.php");
} else {
    echo "Error al actualizar los datos: " . mysqli_error($conn);
}

