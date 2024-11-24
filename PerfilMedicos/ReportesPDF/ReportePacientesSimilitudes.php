<?php
require('../fpdf/fpdf.php');
include('../Principal/funciones.php');
include ('../Principal/conexion.php');
$con = connection();
session_start();
$IdMedico = $_SESSION['IdMedico'];


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $con = connection();
    $IdMedico = $_SESSION['IdMedico'];
    $DatosMedico = InformacionMedico($con, $IdMedico);
    $this->SetFont('Times','B',25);
    $this->SetTextColor(0, 60, 110);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Reporte',0,1,'C');
    $this->Cell(60);
    $this->Cell(70,10,'Pacientes Enfermedades Similares ',0,0,'C');
    $this->Ln(15);
    $this->Image('../Principal/logo.png', 10, 0, 30, 30);
    $this->SetFont('Times','',8);
    $this->SetTextColor(0, 0, 0);
    $AcomodarTexto = 30;
    $this->Cell($AcomodarTexto);
    $this->Cell(70,7,'Medico: ' . $DatosMedico['nombre'],0,0,'L');
    $this->Cell(70,7,'Fecha Del Reporte: ' . date('Y-m-d'),0,1,'L');
    $this->Cell($AcomodarTexto);
    $this->Cell(70,7,'Cedula: ' . $DatosMedico['CedulaProfesional'],0,0,'L');
    $this->Cell(70,7,'Hora Del Reporte: ' . date('H:i:s'),0,1,'L');
    $this->Cell($AcomodarTexto);
    $this->Cell(70,7,'Especialidad: ' . $DatosMedico['especialidad'],0,1,'L');
    $this->Cell($AcomodarTexto);
    $this->Cell(70,7,'Especialidad: ' . $DatosMedico['telefono'],0,1,'L');
    $this->Cell($AcomodarTexto);
    $this->Cell(70,7,'Especialidad: ' . $DatosMedico['correo'],0,1,'L');

    // Salto de línea
    $this->Ln(5);
    $this->SetFillColor(0, 138, 192);
    $this->SetTextColor(255, 255, 255);
    $this->Cell(20,10,'Nombre',1,0,'C',1);
	$this->Cell(20,10,'Apellidos',1,0,'C',1);
    $this->Cell(25,10,'Fecha De Nacimiento',1,0,'C',1);
    $this->Cell(10,10,'Sexo',1,0,'C',1);
    $this->Cell(10,10,'T.D.S',1,0,'C',1);
    $this->Cell(10,10,'Peso',1,0,'C',1);
    $this->Cell(10,10,'Estatura',1,0,'C',1);
    $this->Cell(25,10,'Direccion',1,0,'C',1);
	$this->Cell(20,10,'Correo',1,0,'C',1);
    $this->Cell(20,10,'Telefono',1,0,'C',1);
    $this->Cell(20,10,'Enfermedades',1,1,'C',1);
    
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
}





$Enfermedad = $_GET['Enfermedad'];
$consulta = "call PacientesSimilitudes($IdMedico, '$Enfermedad', null);";
$resultado = mysqli_query($con, $consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',5);
$DatosMedico = null;
while ($row=$resultado->fetch_assoc()) {
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(20,5, $row['nombre'] ,1,0,'C',1);
	$pdf->Cell(20,5,$row['apellido'],1,0,'C',1);
    $pdf->Cell(25,5,$row['fechaNacimiento'],1,0,'C',1);
    $pdf->Cell(10,5,$row['sexo'],1,0,'C',1);
    $pdf->Cell(10,5,$row['TipoDeSangre'],1,0,'C',1);
    $pdf->Cell(10,5,$row['peso'],1,0,'C',1);
    $pdf->Cell(10,5,$row['estatura'],1,0,'C',1);
    $pdf->Cell(25,5,$row['direccion'],1,0,'C',1);
	$pdf->Cell(20,5,$row['CorreoElectronico'],1,0,'C',1);
    $pdf->Cell(20,5,$row['telefono'],1,0,'C',1);
    $pdf->Cell(20,5,$row['enfermedades'],1,1,'C',1);

} 
	$pdf->Output();
?>