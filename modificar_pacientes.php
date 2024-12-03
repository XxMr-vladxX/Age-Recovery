<?php
include('conexion2.php');  // Asegúrate de incluir conexion2.php
$conn = connection();

$idpaciente = $_POST['IdPaciente'];
$direccion = $_POST['Direccion'];
$nombre = $_POST['Nombre'];
$telefono = $_POST['Telefono'];

$update = "UPDATE usuarios SET Direccion='$direccion', Nombre='$nombre', Telefono='$telefono' WHERE IdPaciente='$idpaciente'";
$query = mysqli_query($conn, $update);

if ($query) {
    header("Location:formulario2.php");
} else {
    echo "Error: " . $update . "<br>" . mysqli_error($conn);
}
?>
