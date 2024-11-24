<?php
function connection(){
    $host = "localhost";
    $usuarname = "root";
    $password = "";
    $dbname = "agerecovery";

$conn = mysqli_connect($host, $usuarname, $password) ;

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

mysqli_select_db($conn, $dbname);

return $conn;

}
?>
