<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->SetFillColor(0, 60, 110); // Azul
        $this->SetTextColor(255, 255, 255); // Blanco
        $this->SetDrawColor(173, 173, 173); // Gris
        $this->SetLineWidth(.3);
        $this->SetFont('Arial', 'B', 10);

        $this->Cell(0, 10, 'Reporte de Citas - AgeRecovery', 0, 1, 'C', true);
        $this->Ln(5);

        $this->SetFont('Arial', 'B', 8);
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
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function TableRow($data)
    {
        $this->SetFont('Arial', '', 8);
        $this->SetFillColor(247, 247, 247);

        $this->Cell(30, 8, utf8_decode($data[0]), 1, 0, 'C', true); // Paciente
        $this->Cell(30, 8, utf8_decode($data[1]), 1, 0, 'C', true); // Médico
        $this->Cell(25, 8, utf8_decode($data[2]), 1, 0, 'C', true); // Fecha
        $this->Cell(25, 8, utf8_decode($data[3]), 1, 0, 'C', true); // Hora
        $this->Cell(25, 8, utf8_decode($data[4]), 1, 0, 'C', true); // Estatus
        $this->Cell(35, 8, utf8_decode($data[5]), 1, 1, 'C', true); // Fecha Cancelación
    }
}

include('conexion.php');
$con = connection();

// Llamada al procedimiento almacenado para obtener información de las citas activas
$consulta = "
    SELECT 
        Pacientes.Nombre AS NombrePaciente,
        Medicos.Nombre AS NombreMedico,
        Citas.FechaCita AS Fecha,
        Citas.HoraCita AS Hora,
        Citas.Estatus AS Estatus,
        Citas.FechaCancelacion AS FechaCancelacion
    FROM Citas
    INNER JOIN Pacientes ON Citas.IdPaciente = Pacientes.IdPaciente
    INNER JOIN Medicos ON Citas.IdMedico = Medicos.IdMedico
    WHERE Citas.Estatus = 'Activo';";  // Filtrar citas activas

$resultado = mysqli_query($con, $consulta);

if ($resultado) {
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 8);

    $pdf->SetFillColor(247, 247, 247);
    $pdf->SetTextColor(0, 0, 0);

    while ($row = $resultado->fetch_assoc()) {
        $pdf->TableRow([
            $row['NombrePaciente'], 
            $row['NombreMedico'],    
            $row['Fecha'],           
            $row['Hora'],            
            $row['Estatus'],         
            $row['FechaCancelacion'] ? $row['FechaCancelacion'] : 'N/A'
        ]);
    }

    $pdf->Output();
} else {
    echo "Error en la consulta: " . mysqli_error($con);
}
?>








