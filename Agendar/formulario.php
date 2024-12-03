<?php
include('conexion.php'); // Asegúrate de incluir el script de conexión
session_start();
$conn = connection();


$message = "";




// Buscar paciente por nombre o apellido
if ($_SESSION['IdPaciente']) {
    $nombrePaciente = $_SESSION['IdPaciente'];

    // Consulta para obtener los datos del paciente usando LIKE para búsqueda parcial
    $sql = "SELECT nombre, apellido, fechaNacimiento, sexo, TipoDeSangre, peso, estatura, direccion, CorreoElectronico, telefono, enfermedades, alergias, Cirugias_Accidentes, Estatus, idPaciente
            FROM Pacientes
            WHERE IdPaciente LIKE ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    // Usar el comodín para coincidencia parcial
    $searchTerm = "%{$nombrePaciente}%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $paciente = $result->fetch_assoc();
    $stmt->close();
}

// Obtener la lista de doctores para el dropdown
$doctoresResult = $conn->query("SELECT idMedico, nombre FROM Medicos");
$doctores = [];
while ($doctor = $doctoresResult->fetch_assoc()) {
    $doctores[] = $doctor;
}

function obtenerFechaHoy($formato = "Y-m-d") {
    return date($formato);
}

$FechaHoy = obtenerFechaHoy();
function VerificarHora($con, $FechaHoy, $Hr, $IdMedic){
    $conn = $con;
    if($FechaHoy != "n/a"){
        while (mysqli_next_result($conn));
        $NombrePaciente = "call VerificarHora('$FechaHoy', '$Hr', '$IdMedic');";
        $query2 = mysqli_query($conn, $NombrePaciente);
        if ($query2) {
        $row2 = mysqli_num_rows($query2);
        $Paciente = $row2; 
        $query2->free();
        } else {
        echo "n/a";
        }
        return $Paciente;
    }else{
        $Paciente = array(
            "IdMedico" => "n/a",
            "nombre" => "n/a",
            "CedulaProfesional" => "n/a",
            "especialidad" => "n/a",
            "telefono" => "n/a",
            "correo" => "n/a"
        );
        return $Paciente;
    }
}



// Procesar el formulario de cita
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar los datos del formulario aquí
    $IdPaciente = $_POST['idPacienteActualizar'];
    $fechaCita = $_POST['fechaCita'];
    $horaCita = $_POST['horaCita'];
    $idMedico = $_POST['doctor'];
    $observaciones = $_POST['observaciones'];
    $FechaRegistro = obtenerFechaHoy();
    $Estatus = 'Activo';

    // Consulta para insertar datos en la tabla 'Citas'
    $VerificarHoraz = VerificarHora($conn, $fechaCita, $horaCita, $idMedico);
    if ($VerificarHoraz == 0) {
        $insertSQL = "INSERT INTO Citas (idPaciente, idMedico, Fecha, Hora, Observaciones, FechaRegistro, Estatus)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        while (mysqli_next_result($conn));
        $stmt = $conn->prepare($insertSQL);
        if ($stmt) {
            $stmt->bind_param("iisssss", $IdPaciente, $idMedico, $fechaCita, $horaCita, $observaciones, $FechaRegistro, $Estatus);
            $stmt->execute();
            $result = $stmt->get_result();
            $Cita = $result;
            $stmt->close();
            $mensaje = "Cita registrada con éxito!";
            // Redirigir para evitar reenviar el formulario
        } else {
            $mensaje = "Error al registrar la cita: " . $conn->error;
        }
    }else{
        $message = "Horario No Disponible";
    }
    
}


// Obtener el nombre del médico para mostrarlo
while (mysqli_next_result($conn));
$medicoSQL = "SELECT nombre FROM Medicos WHERE idMedico = ?";
$stmt = $conn->prepare($medicoSQL);
if ($stmt) {
    $stmt->bind_param("i", $idMedico);
    $stmt->execute();
    $result = $stmt->get_result();
    $medico = $result->fetch_assoc();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pacientes</title>
    <script>
        function showMessage(message) {
            if (message) {
                alert(message); // Mostrar mensaje en un cuadro de alerta
            }
        }
    </script>
    <link rel="stylesheet" href="diseño.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        .tarjeta {
            width: 100%;
            max-width: 800px;
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            border: 3px solid #003c6e;
            transition: all 0.3s ease;
            box-sizing: border-box;
            

            
        }

        .tarjeta h2 {
            font-size: 24px;
            color: #003c6e;
            margin-bottom: 20px;
        }

        .tarjeta p {
            font-size: 16px;
            color: #333;
            margin: 8px 0;
        }

        .tarjeta p strong {
            color: #003c6e;
        }

        .campo {
            margin-bottom: 15px;
        }

        .campo label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .campo input,
        .campo select,
        .campo textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .campo textarea {
            resize: vertical;
            height: 100px;
        }

        .campo input[type="submit"] {
            background-color: #003c6e;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .campo input[type="submit"]:hover {
            background-color: #0061a8;
        }

        .mensaje {
            padding: 10px;
            background-color: #eaf7ea;
            color: #4caf50;
            border: 1px solid #4caf50;
            border-radius: 8px;
            margin-top: 20px;
        }

        .tarjeta .detalles-cita {
            margin-top: 30px;
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 8px;
        }

        .detalles-cita p {
            margin: 5px 0;
        }

    </style>
</head>
<body onload="showMessage('<?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>')">

<div class="hero">
        <nav>
            <img src="Age.png" class="logo">
            <ul>
                <li> <a href="../Inicio/inicio2.php">Inicio</a></li>
                <li> <a href="eliminar.php">Tus Citas</a></li>
            </ul>
        </nav>
    </div>

<?php if (isset($paciente)) { ?>
    <div class="tarjeta">
        <h2>Información del Paciente</h2>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($paciente['nombre']); ?></p>
        <p><strong>Apellido:</strong> <?php echo htmlspecialchars($paciente['apellido']); ?></p>
        <p><strong>Fecha de Nacimiento:</strong> <?php echo htmlspecialchars($paciente['fechaNacimiento']); ?></p>
        <p><strong>Sexo:</strong> <?php echo htmlspecialchars($paciente['sexo']); ?></p>
        <p><strong>Tipo de Sangre:</strong> <?php echo htmlspecialchars($paciente['TipoDeSangre']); ?></p>
        <p><strong>Peso:</strong> <?php echo htmlspecialchars($paciente['peso']); ?></p>
        <p><strong>Estatura:</strong> <?php echo htmlspecialchars($paciente['estatura']); ?></p>
        <p><strong>Dirección:</strong> <?php echo htmlspecialchars($paciente['direccion']); ?></p>
        <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($paciente['CorreoElectronico']); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($paciente['telefono']); ?></p>
        <p><strong>Enfermedades:</strong> <?php echo htmlspecialchars($paciente['enfermedades']); ?></p>
        <p><strong>Alergias:</strong> <?php echo htmlspecialchars($paciente['alergias']); ?></p>
        <p><strong>Cirugías/Accidentes:</strong> <?php echo htmlspecialchars($paciente['Cirugias_Accidentes']); ?></p>
        <p><strong>Estatus:</strong> <?php echo htmlspecialchars($paciente['Estatus']); ?></p>

        <?php if (isset($mensaje)) { ?>
            <div class="mensaje"><?php echo $mensaje; ?></div>
        <?php } ?>

        <h2>Agendar Cita</h2>
        <form method="POST" action="">
            <div class="campo">
                <label for="fechaCita"></label>
                <input type="date" name="fechaCita" id="fechaCita" min="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <div class="campo">
                <label for="horaCita"></label>
                <select name="horaCita" id="horaCita" required>
                    <option value="10:00">10:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="12:00">12:00 PM</option>
                    <option value="13:00">01:00 PM</option>
                    <option value="16:00">04:00 PM</option>
                    <option value="17:00">05:00 PM</option>
                    <option value="18:00">06:00 PM</option>
                    <option value="19:00">07:00 PM</option>
                </select>
            </div>
            <div class="campo">
                <label for="doctor"></label>
                <select name="doctor" id="doctor" required>
                    <?php foreach ($doctores as $doctor) { ?>
                        <option value="<?php echo $doctor['idMedico']; ?>" 
                                <?php echo ($doctor['idMedico'] == $idMedico) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($doctor['nombre']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="campo">
                <label for="observaciones"></label>
                <textarea name="observaciones" id="observaciones"></textarea>
            </div>
            <input type="hidden" name="idPacienteActualizar" value="<?php echo htmlspecialchars($paciente['idPaciente']); ?>">
            <input type="submit" value="Agendar">
        </form>

        <?php if (isset($Cita)) { ?>
            <div class="detalles-cita">
                <h3>Detalles de la Cita</h3>
                <p><strong>Médico Asignado:</strong> <?php echo htmlspecialchars($medico['nombre']); ?></p>
                <p><strong>Fecha de la Cita:</strong> <?php echo htmlspecialchars($fechaCita); ?></p>
                <p><strong>Hora de la Cita:</strong> <?php echo htmlspecialchars($horaCita); ?></p>
                <p><strong>Observaciones:</strong> <?php echo htmlspecialchars($observaciones); ?></p>
            </div>
        <?php } ?>
    </div>
<?php } ?>
            
</body>
</html>









































    




























