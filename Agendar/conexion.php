<?php

// Asegúrate de usar include_once para evitar duplicados
include_once('conexion.php');

// Función de conexión
function connection() {
    $host = 'localhost'; // Cambia a tu host
    $usuario = 'root';   // Cambia a tu usuario
    $contraseña = '';    // Cambia a tu contraseña
    $baseDeDatos = 'AgeRecovery'; // Cambia a tu base de datos

    // Crear conexión
    $conn = new mysqli($host, $usuario, $contraseña, $baseDeDatos);

    // Verificar si hay errores de conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn; // Retorna la conexión
}
?>







