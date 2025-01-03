<?php
require('fpdf/fpdf.php');
include ('conexion.php');
$con = connection();

if (isset($_GET['id_Cita'])) {
    // Asignar el valor de idCita a la variable
    $id_Cita = $_GET['id_Cita'];
} else {
    // En caso de que no se pase la idCita en la URL
    echo "No se proporcionó la ID de la cita.";
    exit();  // Terminar el script si no se pasa la idCita
}



class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $con = connection();
    $this->SetFont('Times','B',25);
    $this->SetTextColor(0, 60, 110);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'CITA CANCELADA',0,1,'C');
    $this->Cell(60);
    $this->Ln(15);
    $this->Image('Age.png', 10, 0, 30, 30);
    $this->SetFont('Times','',8);
    $this->SetTextColor(0, 0, 0);
    $AcomodarTexto = 30;
   

    // Salto de línea
    $this->Ln(5);
    $this->SetFillColor(0, 138, 192);
    $this->SetTextColor(255, 255, 255);
    $this->Cell(25);
    $this->Cell(30, 8, 'Paciente', 1, 0, 'C', true);
    $this->Cell(30, 8, 'Medico', 1, 0, 'C', true);
    $this->Cell(25, 8, 'Fecha', 1, 0, 'C', true);
    $this->Cell(25, 8, 'Hora', 1, 0, 'C', true);
    $this->Cell(25, 8, 'Estatus', 1, 1, 'C', true);



   
    
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página') .$this->PageNo().'/{nb}',0,0,'C');
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
  
}
}




while (mysqli_next_result($con));
$consulta = "
    SELECT 
        Pacientes.Nombre AS NombrePaciente,
        Medicos.Nombre AS NombreMedico,
        Citas.Fecha AS Fecha,
        Citas.Hora AS Hora,
        Citas.Estatus AS Estatus,
        Citas.FechaCancelacion AS FechaCancelacion
    FROM Citas
    INNER JOIN Pacientes ON Citas.IdPaciente = Pacientes.IdPaciente
    INNER JOIN Medicos ON Citas.IdMedico = Medicos.IdMedico
    WHERE Citas.Estatus = 'Activo' AND Citas.id_Cita = '$id_Cita';";  
$resultado = mysqli_query($con, $consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',5);
$pdf->Cell(25);
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
?>
