<?php
    include ('conexion.php');
    include ('funciones.php');
    $conn = connection();
    session_start();
    $IdMedico = $_SESSION['IdMedico'];
    $Genero = $_POST['Genero'];


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
    

<table class="table table-dark" style="width: 25%; "> 
    <thead>
        <tr> 
            <th><img src="FotoPerfil.png" height="90" width="90" alt="..."></th> 
            <th colspan="2">Bienvenido: <?php echo $_SESSION['nombre']; ?></th> 
        </tr> 
    </thead> 
    <tbody> 
        <tr> 
            <th colspan="3">Tipos De Reportes</th> 
        </tr>
        <tr class="Boton2"> 
        <td colspan="3"> 
                <form class="BotonesReportes" method="POST" action="ReporteDeEnfermedades.php">
                    <input type="submit" name="boton" class="btn btn-primary" value="Enfermedades Similares" style="width: 100%; height: 100%;"> 
                    <label for="Enfermedad">Elige una Enfermedad:</label>
                <select name="Enfermedad" id="Enfermedad" class="custom-select">
                            <option value="Gastritis">Gastritis</option>
                            <option value="Migraña">Migraña</option>
                            <option value="Diabetes">Diabetes</option>
                            <option value="Asma">Asma</option>
                            <option value="Autismo">Autismo</option>
                            <option value="Herpes">Herpes</option>
                            <option value="Artritis">Artritis</option>
                            <option value="Otra">Otra</option>
                            <option value="Ninguna">Ninguna</option>
                 </select>
                </form>
             </td>
        </tr> 

        <tr class="EspacioMiniReportes">
            <td colspan="3"></td>
        </tr>

        <tr class="Boton2"> 
        <td colspan="3"> 
                <form class="BotonesReportes" method="POST" action="ReportesMedicos.php">
                <input type="submit" name="boton" class="btn btn-primary" value="Reporte Por Genero" style="width: 100%; height: 100%;"> 
                <label for="Genero">Elige un Genero:</label>
                <select name="Opciones" id="opciones" class="custom-select">
                 <option value="Masculino">Masculino</option>
                 <option value="Femenino">Femenino</option>
                 </select>
                </form>
             </td>
        </tr> 

        <tr class="EspacioMiniReportes">
            <td colspan="3"></td>
        </tr>

        <tr class="Boton2"> 
        <td colspan="3"> 
                <form class="BotonesReportes" method="POST" action="ReporteTopPacientes.php">
                    <input type="submit" name="boton" class="btn btn-primary" value="Reporte De Cancelaciones" style="width: 100%; height: 100%;"> 
                </form>
             </td>
        </tr> 
        

        <tr class="Espacio">
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr class="Boton2">
            <td colspan="3"> 
                <form class="BotonesLargos" method="POST" action="InicioMedicos.php">
                    <input type="submit" name="boton" class="btn btn-primary" value="CITAS" style="width: 100%;"> 
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



        <tr class="Espacio">
            <td colspan="3"></td>
        </tr>
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

<table class="InformacionDeLaCita" style="width: 70%">
                <tr class="HeaderDeLaTabla">
                    <th colspan="13">
                        ELIGE UN <br>
                        REPORTE
                    </th>
                </tr>
                <tr class="SubtituloPacienteInfo">
                     <td>Nombre</td>
                     <td>Apellido</td>
                     <td>Fecha De Nacimiento</td>
                     <td>Sexo</td>
                     <td>Tipo De Sangre</td>
                     <td>Peso</td>
                     <td>Estatura</td>
                     <td>Direccion</td>
                     <td>Correo Electronico</td>
                     <td>Telefono</td>
                     <td>Enfermedades</td>
                     <td>Alergias</td>
                     <td>Cirugias</td>
                </tr>
                <?php  
                        while (mysqli_next_result($conn));
                      $NombrePaciente = "call PacientesPorGenero($IdMedico, '$Genero', 8);";
                       $query2 = mysqli_query($conn, $NombrePaciente);
                      while($row=mysqli_fetch_array($query2)):?>
                        <tr class="InformacionDelPaciente">
                        <td><?php echo $row['nombre'] ?> </td>
                        <td><?php echo $row['apellido'] ?> </td>
                        <td><?php echo $row['fechaNacimiento'] ?> </td>
                        <td><?php echo $row['sexo'] ?> </td>
                        <td><?php echo $row['TipoDeSangre'] ?> </td>
                        <td><?php echo $row['peso'] ?> </td>
                        <td><?php echo $row['estatura'] ?> </td>
                        <td><?php echo $row['direccion'] ?> </td>
                        <td><?php echo $row['CorreoElectronico'] ?> </td>
                        <td><?php echo $row['telefono'] ?> </td>
                        <td><?php echo $row['enfermedades'] ?> </td>
                        <td><?php echo $row['alergias'] ?> </td>
                        <td><?php echo $row['Cirugias_Accidentes'] ?> </td>
                </tr>
                <?php endwhile;?>
                <tr class="SubtituloPaciente">
                    <td colspan="8"></td>
                    <td colspan="5"> 
                    <form class="BotonesLargos" method="get" action="ReportePacientesHombres.php" target="_blank">
                    <input type="hidden" name = "Genero" value="<?php echo $Genero;?>">
                    <input type="submit" name="boton" class="btn btn-primary" value="Imprimir Documento PDF" style="width: 100%;"> 
                      </form>
                    </td>
                </tr>
            </table>

          
</body>

</html>
