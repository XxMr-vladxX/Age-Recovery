<?php
include('conexion.php');
$conn = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombrePaciente = $_POST['NombrePaciente'];
    $fechaCita = $_POST['fechaCita'];
    $horaCita = $_POST['horaCita'];
    $medico = $_POST['medico'];
    $observaciones = $_POST['observaciones']; // Agregamos un campo para observaciones
    $fechaRegistro = date("Y-m-d H:i:s");

    // Buscar idPaciente por el nombre
    $sql_select_paciente = "SELECT IdPaciente FROM Pacientes WHERE nombre = ?";
    $stmt_select_paciente = $conn->prepare($sql_select_paciente);
    $stmt_select_paciente->bind_param("s", $nombrePaciente);
    $stmt_select_paciente->execute();
    $result_paciente = $stmt_select_paciente->get_result();

    if ($result_paciente->num_rows > 0) {
        $row_paciente = $result_paciente->fetch_assoc();
        $idPaciente = $row_paciente['IdPaciente'];

        // Insertar una nueva cita
        $sql_insert = "INSERT INTO Citas (idPaciente, idMedico, Fecha, Hora, Observaciones, FechaRegistro, Estatus) 
                       VALUES (?, ?, ?, ?, ?, ?, 'Activo')";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("iissss", $idPaciente, $medico, $fechaCita, $horaCita, $observaciones, $fechaRegistro);
        $stmt_insert->execute();

        if ($stmt_insert->affected_rows > 0) {
            echo "<p>Cita agendada exitosamente.</p>";
        } else {
            echo "<p>No se pudo agendar la cita.</p>";
        }

        $stmt_insert->close();
    } else {
        echo "<p>El paciente no fue encontrado en el sistema.</p>";
    }

    $stmt_select_paciente->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <link rel="stylesheet" href="diseño_formulario.css">
</head>
<body>
    <form method="POST" action="">
        <label for="NombrePaciente">Nombre del Paciente:</label>
        <input type="text" id="NombrePaciente" name="NombrePaciente" required>

        <label for="fechaCita">Fecha de la Cita:</label>
        <input type="date" id="fechaCita" name="fechaCita" required>

        <label for="horaCita">Hora de la Cita:</label>
        <input type="time" id="horaCita" name="horaCita" required>

        <label for="medico">ID del Médico:</label>
        <input type="number" id="medico" name="medico" required>

        <label for="observaciones">Observaciones:</label>
        <textarea id="observaciones" name="observaciones" required></textarea>

        <button type="submit">Agendar Cita</button>
    </form>

    <a href="formulario.php">Volver al Formulario</a>
</body>
</html>

