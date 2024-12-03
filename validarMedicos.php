<?php

if (!empty($_POST["button"])){
    if (!empty($_POST["usuario"] and !empty($_POST["contrasena"]))){
        if(session_start()){
            session_destroy();
        }
        session_start();
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        $sql=$conn->query("call VerificarInicioDeSesionMedico ('{$usuario}', '{$contrasena}')");
        if ($datos=$sql->fetch_object()){
            $_SESSION["IdMedico"] = $datos->IdMedico;
            $_SESSION["nombre"] = $datos->nombre;
            $_SESSION["Contraseña"] = $datos->contrasena;
            header ("location: InicioMedicos.php");
        }
        else{
            echo "Usuario o Contraseña Incorrectos";
        }
    }else{
       echo "Campos Vacios";
    }
}

