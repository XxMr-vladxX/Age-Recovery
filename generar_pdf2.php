<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Colores de fondo y texto
        $this->SetFillColor(0, 60, 110); // Azul
        $this->SetTextColor(255, 255, 255); // Blanco
        $this->SetDrawColor(173, 173, 173); // Gris
        $this->SetLineWidth(.3);
        $this->SetFont('Arial', 'B', 10); // Fuente más pequeña

        // Título centrado
        $this->Cell(0, 10, 'Reporte de Cancelaciones', 0, 1, 'C', true);
        $this->Ln(5);

        // Encabezados de columna con bordes y colores
        $this->SetFont('Arial', 'B', 8); // Fuente más pequeña
        $this->Cell(30, 8, 'Paciente', 1, 0, 'C', true);
        $this->Cell(30, 8, 'Medico', 1, 0, 'C', true);
        $this->Cell(25, 8, 'Fecha', 1, 0, 'C', true);
        $this->Cell(25, 8, 'Hora', 1, 0, 'C', true);
        $this->Cell(25, 8, 'Estatus', 1, 0, 'C', true);
        $this->Cell(35, 8, 'Fecha Cancelacion', 1, 1, 'C', true);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Método para mejorar la visualización de la tabla
    function TableRow($data)
    {
        $this->SetFont('Arial', '', 8); // Fuente más pequeña
        $this->SetFillColor(247, 247, 247); // Fondo gris claro

        // Ajustamos el ancho de las celdas para que todo quede bien alineado
        $this->Cell(30, 8, utf8_decode($data[0]), 1, 0, 'C', true); // Paciente
        $this->Cell(30, 8, utf8_decode($data[1]), 1, 0, 'C', true); // Medico
        $this->Cell(25, 8, utf8_decode($data[2]), 1, 0, 'C', true); // Fecha
        $this->Cell(25, 8, utf8_decode($data[3]), 1, 0, 'C', true); // Hora
        $this->Cell(25, 8, utf8_decode($data[4]), 1, 0, 'C', true); // Estatus
        $this->Cell(35, 8, utf8_decode($data[5]), 1, 1, 'C', true); // Fecha Cancelación
    }
}

include('conexion.php');
$con = connection();

// Llamada al procedimiento almacenado para obtener solo pacientes activos
// Ahora obtenemos el nombre del paciente y del médico de las tablas correspondientes
$consulta = "
    SELECT 
        Pacientes.nombre AS NombrePaciente,
        Medicos.nombre AS NombreMedico,
        Citas.Fecha,
        Citas.Hora,
        Citas.Estatus,
        Citas.FechaCancelacion
    FROM Citas
    JOIN Pacientes ON Citas.idPaciente = Pacientes.idPaciente
    JOIN Medicos ON Citas.idMedico = Medicos.idMedico
    WHERE Citas.Estatus = 'Activo'";  // Solo pacientes activos
$resultado = mysqli_query($con, $consulta);

// Comprobar si la consulta devuelve resultados
if ($resultado) {
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 8); // Fuente más pequeña

    // Colores de fondo y texto de la tabla
    $pdf->SetFillColor(247, 247, 247); // Fondo gris claro
    $pdf->SetTextColor(0, 0, 0); // Negro

    // Recorrer los resultados de la consulta y generar la tabla
    while ($row = $resultado->fetch_assoc()) {
        $pdf->TableRow([
            $row['NombrePaciente'],  // Nombre del paciente
            $row['NombreMedico'],    // Nombre del médico
            $row['Fecha'],           // Fecha de la cita
            $row['Hora'],            // Hora de la cita
            $row['Estatus'],         // Estatus de la cita
            $row['FechaCancelacion'] ? $row['FechaCancelacion'] : 'N/A'  // Fecha de cancelación (si existe)
        ]);
    }

    // Generar el PDF
    $pdf->Output();
} else {
    echo "Error en la consulta: " . mysqli_error($con);
}
?>
