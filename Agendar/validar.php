<?php
session_start();
include ('conexion.php');
$conn = connection();

if (!empty($_POST["boton"])) {
    if (!empty($_POST["Correo"]) && !empty($_POST["Contraseña"])) {
        $Correo = $_POST['Correo'];
        $Contraseña = $_POST['Contraseña'];

        $sql = $conn->query("call pruebas.validar('{$Correo}', '{$Contraseña}')");
        if ($datos = $sql->fetch_object()) {
            $_SESSION["IdUsuario"] = $datos->IdUsuario; 
            $_SESSION["Correo"] = $datos->Correo;
            $_SESSION["Contraseña"] = $datos->Contraseña;
            header("Location: formulario.php");
        } else {
            echo "Usuario o contraseña incorrectos";
        }
    } else {
        echo "Campos vacíos";
    }
}
$conn->close();
?>


