<?php
    include ('conexion.php');
    include ('funciones.php');
    $conn = connection();
    session_start();

    $consultar = "SELECT * FROM Pacientes";
    $consultarCitas = "SELECT * FROM Citas";
    $result=mysqli_query($conn, $consultar);

    $IdMedico = $_SESSION['IdMedico'];
    if (isset($_POST['IdPaciente'])) {
        $IdPaciente = $_POST['IdPaciente'];
    } else {
        $IdPaciente = "n/a";
    }

    if (isset($_POST['IdCita'])) {
        $IdCita = $_POST['IdCita'];
    } else {
        $IdCita = "n/a";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicos</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<header>
<div class="hero">
        <nav>
            <img src="logo.png" class="logo">
            <ul>
                <li> <a href="InicioDeSesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </div>
</header>
<body>



<table class="table table-dark" style="width: 25%;">
    <thead>
        <tr> 
            <th><img src="FotoPerfil.png" height="90" width="90" alt="..."></th> 
            <th colspan="2">Bienvenido: <?php echo $_SESSION['nombre']; ?></th> 
        </tr> 
    </thead> 
    <tbody> 
        <tr> 
            <th>HORA</th> 
            <th>PACIENTE</th> 
            <th>ESTATUS</th>
        </tr>
        <tr> 
            <td class="Hora"> 
                <?php $datos = HorarioCita($conn, '10:00:00', $IdMedico);?> 
                <form method="POST" action="">
                    <input type="hidden" name="IdPaciente" value="<?= $datos['IdPaciente'] ?>">
                    <input type="hidden" name="IdCita" value="<?= $datos['IdCita'] ?>">
                    <input type="submit" name="boton" class="btn btn-primary" value=">">10:00-11:00 
                </form>
            </td>
            <td><?php echo $datos['Paciente']['nombre']; ?></td> 
            <td><?php echo $datos['Estatus']; ?></td>
        </tr> 
        <tr>
            <td class="Hora">
                <?php $datos = HorarioCita($conn, '11:00:00', $IdMedico);?> 
                <form method="POST" action="">
                    <input type="hidden" name="IdPaciente" value="<?= $datos['IdPaciente'] ?>">
                    <input type="hidden" name="IdCita" value="<?= $datos['IdCita'] ?>">
                    <input type="submit" name="boton" class="btn btn-primary" value=">">11:00-12:00 
                </form>
            </td>
            <td><?php echo $datos['Paciente']['nombre']; ?></td> 
            <td><?php echo $datos['Estatus']; ?></td> 
        </tr> 
        <tr>
            <td class="Hora">
                <?php $datos = HorarioCita($conn, '12:00:00', $IdMedico);?> 
                <form method="POST" action="">
                    <input type="hidden" name="IdPaciente" value="<?= $datos['IdPaciente'] ?>">
                    <input type="hidden" name="IdCita" value="<?= $datos['IdCita'] ?>">
                    <input type="submit" name="boton" class="btn btn-primary" value=">">12:00-1:00 
                </form>
            </td>
            <td><?php echo $datos['Paciente']['nombre']; ?></td> 
            <td><?php echo $datos['Estatus']; ?></td> 
        </tr> 
        <tr> 
            <td class="Hora">
                <?php $datos = HorarioCita($conn, '13:00:00', $IdMedico);?> 
                <form method="POST" action="">
                    <input type="hidden" name="IdPaciente" value="<?= $datos['IdPaciente'] ?>">
                    <input type="hidden" name="IdCita" value="<?= $datos['IdCita'] ?>">
                    <input type="submit" name="boton" class="btn btn-primary" value=">">1:00-2:00 
                </form>
            </td> 
            <td><?php echo $datos['Paciente']['nombre']; ?></td> 
            <td><?php echo $datos['Estatus']; ?></td> 
        </tr> 
        <tr> 
            <td class="Hora">
                <?php $datos = HorarioCita($conn, '16:00:00', $IdMedico);?> 
                <form method="POST" action="">
                    <input type="hidden" name="IdPaciente" value="<?= $datos['IdPaciente'] ?>">
                    <input type="hidden" name="IdCita" value="<?= $datos['IdCita'] ?>">
                    <input type="submit" name="boton" class="btn btn-primary" value=">">4:00-5:00 
                </form>
            </td>
            <td><?php echo $datos['Paciente']['nombre']; ?></td> 
            <td><?php echo $datos['Estatus']; ?></td> 
        </tr>
        <tr>
            <td class="Hora">
                <?php $datos = HorarioCita($conn, '17:00:00', $IdMedico);?> 
                <form method="POST" action="">
                    <input type="hidden" name="IdPaciente" value="<?= $datos['IdPaciente'] ?>">
                    <input type="hidden" name="IdCita" value="<?= $datos['IdCita'] ?>">
                    <input type="submit" name="boton" class="btn btn-primary" value=">">5:00-6:00 
                </form>
            </td> 
            <td><?php echo $datos['Paciente']['nombre']; ?></td> 
            <td><?php echo $datos['Estatus']; ?></td>
        </tr>
        <tr> 
            <td class="Hora">
                <?php $datos = HorarioCita($conn, '18:00:00', $IdMedico);?> 
                <form method="POST" action="">
                    <input type="hidden" name="IdPaciente" value="<?= $datos['IdPaciente'] ?>">
                    <input type="hidden" name="IdCita" value="<?= $datos['IdCita'] ?>">
                    <input type="submit" name="boton" class="btn btn-primary" value=">">6:00-7:00 
                </form>
            </td>
            <td><?php echo $datos['Paciente']['nombre']; ?></td> 
            <td><?php echo $datos['Estatus']; ?></td> 
        </tr> 
        <tr>
            <td class="Hora">
                <?php $datos = HorarioCita($conn, '19:00:00', $IdMedico);?> 
                <form method="POST" action="">
                    <input type="hidden" name="IdPaciente" value="<?= $datos['IdPaciente'] ?>">
                    <input type="hidden" name="IdCita" value="<?= $datos['IdCita'] ?>">
                    <input type="submit" name="boton" class="btn btn-primary" value=">">7:00-8:00 
                </form>
            </td>
            <td><?php echo $datos['Paciente']['nombre']; ?></td>
            <td><?php echo $datos['Estatus']; ?></td> 
        </tr>

        <tr class="Espacio">
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr class="Boton2">
            <td colspan="3"> 
                <form class="BotonesLargos" method="POST" action="ReportesMedicos.php">
                    <input type="submit" name="boton" class="btn btn-primary" value="REPORTES" style="width: 100%;"> 
                </form>
            </td>
        </tr>

        <tr class="EspacioMini">
            <td colspan="3"></td>
        </tr>

        <tr class="Boton2">
            <td colspan="3"> 
                <form class="BotonesLargos" method="get" action="InformacionMedico.php">
                    <input type="submit" name="boton" class="btn btn-primary" value="INFORMACION" style="width: 100%;"> 
                </form>
            </td>
        </tr>

        <tr class="Espacio">
            <td colspan="3"></td>
        </tr>
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

            <table class="InformacionDeLaCita" style="width: 70%">
                <tr class="HeaderDeLaTabla">
                    <th colspan="3">
                        INFORMACION DE LA <br>
                        CITA
                    </th>
                </tr>
                <tr class="SubtituloPaciente">
                    <td colspan="3"> Informacion Del Paciente </td>
                </tr>
                <?php $DatosPaciente = InformacionPaciente($conn, $IdPaciente);
                      $DatosCita = InformacionCita($conn, $IdCita)?>
                <tr class="InformacionDelPaciente">
                    <td colspan="1"> Nombre: <?php echo $DatosPaciente['nombre'] ?> </td>
                    <td colspan="2"> Apellidos: <?php echo $DatosPaciente['apellido'] ?> </td>
                </tr>
                <tr class="InformacionDelPaciente">
                    <td> IdPaciente: <?php echo $DatosPaciente['IdPaciente'] ?> </td>
                    <td> Sexo: <?php echo $DatosPaciente['sexo'] ?> </td>
                    <td> Fecha De Nacimiento: <?php echo $DatosPaciente['fechaNacimiento'] ?> </td>
                </tr>
                <tr class="InformacionDelPaciente">
                    <td> Tipo De Sangre: <?php echo $DatosPaciente['TipoDeSangre'] ?> </td>
                    <td> Telefono: <?php echo $DatosPaciente['telefono'] ?> </td>
                    <td> Peso: <?php echo $DatosPaciente['peso'] ?> KG </td>
                </tr>
                <tr class="InformacionDelPaciente">
                    <td> Estatura: <?php echo $DatosPaciente['estatura'] ?>m </td>
                    <td colspan="2"> Direccion: <?php echo $DatosPaciente['direccion'] ?> </td>
                </tr>
                <tr class="InformacionDelPaciente">
                    <td colspan="3"> Email: <?php echo $DatosPaciente['CorreoElectronico'] ?> </td>
                </tr>
                <tr class="InformacionDelPaciente">
                    <td colspan="1"> Alergias: <?php echo $DatosPaciente['alergias'] ?> </td>
                    <td colspan="2"> Cirujias Previas: <?php echo $DatosPaciente['Cirugias_Accidentes'] ?> </td>
                </tr>

                <tr class="SubtituloPaciente">
                    <td colspan="3"> Informacion De La Cita </td>
                </tr>
                <tr class="InformacionDelPaciente">
                    <td colspan="2"> Fecha: <?php echo $DatosCita['Fecha']?> </td>
                    <td colspan="1"> Hora: <?php echo $DatosCita['Hora']?> </td>
                </tr>
                <tr class="InformacionDelPaciente">
                     <td colspan="3">Observaciones:  <?php echo $DatosCita['Observaciones']?> </td>
                </tr>
                <tr class="InformacionDelPaciente">
                     <td colspan="3"> Fecha De Registro: <?php echo $DatosCita['FechaRegistro']?> </td>
                </tr>
                <tr class="InformacionDelPaciente">
                     <td colspan="3"> Fecha De Cancelacion: <?php echo $DatosCita['FechaCancelacion']?> </td>
                </tr>
            </table>

          
</body>

</html>
