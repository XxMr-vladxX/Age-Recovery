<?php
// Conexión a la base de datos
include('conexion.php'); // Asegúrate de que este archivo contiene la conexión correcta
$conn = connection();
session_start();

// Consultar médicos para el dropdown
$doctoresResult = $conn->query("SELECT idMedico, nombre FROM Medicos");
$doctores = [];
while ($doctor = $doctoresResult->fetch_assoc()) {
    $doctores[] = $doctor;
}

// Buscar citas activas de un paciente
function obtenerCitasActivas($conn, $idPaciente) {
    $sql = "SELECT 
                Citas.id_Cita, 
                Citas.Fecha AS FechaCita, 
                Citas.Hora AS HoraCita, 
                Medicos.nombre AS Doctor, 
                Pacientes.nombre AS NombrePaciente, 
                Pacientes.apellido AS Apellido, 
                Pacientes.direccion AS Direccion, 
                Pacientes.fechaNacimiento AS FechaNacimiento, 
                Citas.Estatus
            FROM 
                Citas
            JOIN 
                Medicos ON Citas.idMedico = Medicos.idMedico
            JOIN 
                Pacientes ON Citas.idPaciente = Pacientes.idPaciente
            WHERE 
                Pacientes.idPaciente = ? 
                AND Citas.Estatus = 'Activo'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $idPaciente);
    $stmt->execute();
    return $stmt->get_result();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = [];
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action === 'update') {
            // Actualizar cita
            $idCita = $_POST['id_Cita'];
            $nuevaFecha = $_POST['nuevaFecha'];
            $nuevaHora = $_POST['nuevaHora'];
            $nuevoDoctor = $_POST['nuevoDoctor'];

            $sql_update = "UPDATE Citas SET Fecha = ?, Hora = ?, idMedico = ? WHERE id_Cita = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("ssii", $nuevaFecha, $nuevaHora, $nuevoDoctor, $idCita);
            $stmt_update->execute();

            $response['status'] = 'success';
            $response['message'] = 'Cita actualizada exitosamente.';
        } elseif ($action === 'cancel') {
            // Cancelar cita
            $idCita = $_POST['id_Cita'];
            $fechaHoy = date("Y-m-d H:i:s");
            $sql_update = "UPDATE Citas SET Estatus = 'Inactivo', FechaCancelacion = ? WHERE id_Cita = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("si", $fechaHoy, $idCita);
            $stmt_update->execute();

            $response['status'] = 'success';
            $response['message'] = 'Cita cancelada exitosamente.';
        }
    }
    echo json_encode($response);
    exit();
}

$idPaciente = $_SESSION['IdPaciente'];

$citas = obtenerCitasActivas($conn, $idPaciente);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar y Cancelar Cita</title>
    <link rel="stylesheet" href="diseño_eliminar.css">
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
    <script>
        async function actualizarCita(idCita) {
            const nuevaFecha = document.querySelector(`#nuevaFecha-${idCita}`).value;
            const nuevaHora = document.querySelector(`#nuevaHora-${idCita}`).value;
            const nuevoDoctor = document.querySelector(`#nuevoDoctor-${idCita}`).value;

            const formData = new FormData();
            formData.append('action', 'update');
            formData.append('id_Cita', idCita);
            formData.append('nuevaFecha', nuevaFecha);
            formData.append('nuevaHora', nuevaHora);
            formData.append('nuevoDoctor', nuevoDoctor);

            const response = await fetch('', { method: 'POST', body: formData });
            const result = await response.json();

            if (result.status === 'success') {
                alert(result.message);
                recargarCitas();
            } else {
                alert('Error al actualizar la cita.');
            }
        }

        async function cancelarCita(idCita) {
            const formData = new FormData();
            formData.append('action', 'cancel');
            formData.append('id_Cita', idCita);

            const response = await fetch('', { method: 'POST', body: formData });
            const result = await response.json();

            if (result.status === 'success') {
                alert(result.message);
                recargarCitas();
            } else {
                alert('Error al cancelar la cita.');
            }
        }



        async function GenerarPDFCita(idCita) {
            
            const url = `ReportesPDF/ReporteTuCita.php?idCita=${idCita}`;
            
             window.location.href = url;

             
        }

        async function GenerarPDFCitaCancelada(idCita) {
            
            const url = `ReportesPDF/ReporteTuCitaCancelada.php?idCita=${idCita}`;
            
             window.location.href = url;

             
        }

        async function recargarCitas() {
            const response = await fetch(''); // Llamar al mismo archivo para obtener las citas
            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const tarjetas = doc.querySelector('.tarjetas');
            document.querySelector('.tarjetas').innerHTML = tarjetas.innerHTML;
        }
    </script>
</head>
<body>
<div class="hero">
        <nav>
            <img src="Age.png" class="logo">
            <ul>
                <li> <a href="../Inicio/inicio2.php">Inicio</a></li>
                <li> <a href="formulario.php">Agendar Cita</a></li>
            </ul>
        </nav>
    </div>
    <div class="tarjetas">
        <?php if ($citas->num_rows > 0): ?>
            <?php while ($cita = $citas->fetch_assoc()): ?>
                <div class="tarjeta">
                     <h2>Información del Paciente</h2>
                    <p><strong>Paciente:</strong> <?= $cita['NombrePaciente'] ?> <?= $cita['Apellido'] ?></p>
                    <p><strong>Fecha de Cita:</strong> <?= $cita['FechaCita'] ?></p>
                    <p><strong>Hora de Cita:</strong> <?= $cita['HoraCita'] ?></p>
                    <p><strong>Doctor:</strong> <?= $cita['Doctor'] ?></p>
                    <div class="campo">
                        <label>Nueva Fecha:</label>
                        <input type="date" id="nuevaFecha-<?= $cita['id_Cita'] ?>" required>
                    </div>
                    <div class="campo">
                        <label>Nueva Hora:</label>
                        <select id="nuevaHora-<?= $cita['id_Cita'] ?>" required>
                            <option value="" disabled selected>Seleccione Una Hora</option>
                            <option value="10:00:00">10:00AM</option>
                            <option value="11:00:00">11:00AM</option>
                            <option value="12:00:00">12:00AM</option>
                            <option value="13:00:00">1:00PM</option>
                            <option value="16:00:00">4:00PM</option>
                            <option value="17:00:00">5:00PM</option>
                            <option value="18:00:00">6:00PM</option>
                            <option value="19:00:00">7:00PM</option>
                       </select>
                    </div>
                    <div class="campo">
                        <label>Nuevo Doctor:</label>
                        <select id="nuevoDoctor-<?= $cita['id_Cita'] ?>" required>
                            <option value="" disabled selected>Seleccione un doctor</option>
                            <?php foreach ($doctores as $doctor): ?>
                                <option value="<?= $doctor['idMedico'] ?>"><?= $doctor['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button onclick="actualizarCita(<?= $cita['id_Cita'] ?>)">Actualizar</button>
                    <button onclick="cancelarCita(<?= $cita['id_Cita'] ?>)">Cancelar</button>
                    <button onclick="GenerarPDFCita(<?= $cita['id_Cita'] ?>)">Genera Comprobante</button>
                    <button onclick="GenerarPDFCitaCancelada(<?= $cita['id_Cita'] ?>)">Comprobante de cancelacion</button>
               
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No se encontraron citas activas.</p>
        <?php endif; ?>
    </div>
</body>
</html>



        






























