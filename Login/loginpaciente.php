<?php
session_start();
if(!empty($_POST["button"])) {
    $pacientes = $_POST['CorreoElectronico'];
    $password = $_POST['contrasena'];

    if (!empty($pacientes) && !empty($password)) {

        $sql = $conn->query("CALL validarlogin('{$pacientes}', '{$password}')");

        if ($datos =$sql ->fetch_object()){
            $_SESSION["IdPaciente"] = $datos-> IdPaciente;
            $_SESSION["nombre"] = $datos-> nombre;
            $_SESSION["CorreoElectronico"] = $datos-> CorreoElectronico;
            $_SESSION["contrasena"] = $datos-> contrasena;
            header("Location: ../Inicio/inicio2.php");
            exit();
        } else {
            echo "Usuario o contraseña incorrectos";
        }
    } else {
        echo "Campos vacios";
    }


}