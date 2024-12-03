<?php
    include ('conexion.php');
    include ('funciones.php');
    $conn = connection();
    session_start();

    $consultar = "SELECT * FROM Pacientes";
    $consultarCitas = "SELECT * FROM Citas";
    $result=mysqli_query($conn, $consultar);

    $IdMedico = $_SESSION['IdMedico'];
    if (isset($_GET['IdPaciente'])) {
        $IdPaciente = $_GET['IdPaciente'];
    } else {
        $IdPaciente = "n/a";
    }

    if (isset($_GET['IdCita'])) {
        $IdCita = $_GET['IdCita'];
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
        </tr> </thead> 
        <tbody> 
            <tr> 
                <th>HORA</th> 
                <th>PACIENTE</th> 
                <th>ESTATUS</th>
             </tr>
              <tr> 
                <td> <?php $datos = HorarioCita($conn, '10:00:00', $IdMedico);?> 
               10:00-11:00 </td>
                 <td>
                    <?php 
                
                    
                    echo $datos['Paciente']['nombre'];
                 ?>
                 </td> 
                 <td><?php echo $datos['Estatus']; ?></td>
                 </tr> 
                 <tr>
                     <td><?php $datos = HorarioCita($conn, '11:00:00', $IdMedico);?> 
               11:00-12:00 </td>
                     <td><?php 
                            echo $datos['Paciente']['nombre'];
                      ?></td> 
                     <td><?php echo $datos['Estatus']; ?></td> 
                    </tr> 
                     <tr>
                         <td>
                         <?php $datos = HorarioCita($conn, '12:00:00', $IdMedico);?>
                        12:00-1:00 </td>
                         <td><?php 
                            
                            echo $datos['Paciente']['nombre'];
                      ?></td> 
                         <td><?php echo $datos['Estatus']; ?></td> 
                        </tr> 
                        <tr> 
                            <td>
                            <?php $datos = HorarioCita($conn, '13:00:00', $IdMedico);?>
                          1:00-2:00 </td> 
                            <td><?php 
                            
                            echo $datos['Paciente']['nombre'];
                      ?></td> 
                            <td><?php echo $datos['Estatus']; ?></td> 
                        </tr> 
                        <tr> 
                            <td>
                            <?php $datos = HorarioCita($conn, '16:00:00', $IdMedico);?>
                           4:00-5:00 </td>
                             <td><?php 
                           
                            echo $datos['Paciente']['nombre'];
                      ?></td> 
                             <td><?php echo $datos['Estatus']; ?></td> 
                            </tr>
                             <tr>
                                 <td>
                                 <?php $datos = HorarioCita($conn, '17:00:00', $IdMedico);?>
                                5:00-6:00 </td> 
                                 <td><?php 
                           
                            echo $datos['Paciente']['nombre'];
                      ?></td> 
                                 <td><?php echo $datos['Estatus']; ?></td>
                                 </tr>
                                  <tr> 
                                    <td>
                                    <?php $datos = HorarioCita($conn, '18:00:00', $IdMedico);?>
                                   6:00-7:00 </td>
                                     <td><?php 
                            
                            echo $datos['Paciente']['nombre'];
                      ?></td>
                                      <td><?php echo $datos['Estatus']; ?></td> 
                                    </tr> 
                                    <tr>
                                         <td>
                                         <?php $datos = HorarioCita($conn, '19:00:00', $IdMedico);?>
                                        7:00-8:00 </td>
                                          <td><?php 
                            
                                            echo $datos['Paciente']['nombre'];
                                         ?></td>
                                           <td><?php echo $datos['Estatus']; ?></td> 
                                        </tr>

                                       
                                         <tr class="Espacio">
                                         <td></td>
                                         <td></td>
                                         <td></td>
                                         </tr>

                                         <tr class="Boton2">
                                         <td colspan="3"> 
                                            <form class = "BotonesLargos" method = "POST" action = "ReportesMedicos.php">
                                            <input type="submit" name="boton" class="btn btn-primary" value="REPORTES" style="width: 100%;"> </form></td>
                                         </tr>

                                         <tr class="EspacioMini">
                                         <td colspan="3"></td>
                                         </tr>

                                         <tr class="Boton2">
                                         <td colspan="3"> <form class = "BotonesLargos" method = "POST" action = "InicioMedicos.php">
                                         <input type="submit" name="boton" class="btn btn-primary" value="CITAS" style="width: 100%;"> </form></td>
                                         </tr>


                                         <tr class="Espacio">
                                         <td colspan="3"></td>
                               
                                         </tr>
                                     </tbody>
                                     </table> <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js">
                                     </script> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script> 
                                     
            </table>
            <table class="InformacionDeLaCita" style="width: 70%">
                <tr class="HeaderDeLaTabla">
                    <th colspan="3">
                    <?php $DatosPaciente = InformacionMedico($conn, $IdMedico);
                     echo $DatosPaciente['nombre'] ?>
                    </th>
                </tr>
                <tr class="SubtituloPaciente">
                    
                    <td colspan="3"> Informacion General </td>
                </tr>
                <tr class="InformacionDelPaciente">
                    <td colspan="3"> Nombre: <?php echo $DatosPaciente['nombre'] ?> </td>
                </tr>
                <tr class="InformacionDelPaciente">
                    <td> Cedula Profecional: <?php echo $DatosPaciente['CedulaProfesional'] ?> </td>
                    <td colspan="2"> Especialidad: <?php echo $DatosPaciente['especialidad'] ?> </td>
                </tr>
                <tr class="InformacionDelPaciente">
                    <td> Telefono: <?php echo $DatosPaciente['telefono'] ?> </td>
                    <td colspan="2"> Correo: <?php echo $DatosPaciente['correo'] ?> </td>
                </tr>
                <tr class="InformacionDelPaciente">
                    <td> Id: <?php echo $DatosPaciente['IdMedico'] ?>   </td>
                    <td colspan="2">  </td>
                </tr>
                <tr class="InformacionDelPaciente">
                    <td colspan="3"> </td>
                </tr>
                <tr class="InformacionDelPaciente">
                    <td colspan="1">  </td>
                    <td colspan="2"> </td>
                </tr>

                <tr class="SubtituloPaciente">
                    <td colspan="3"> </td>
                </tr>
                <tr class="InformacionDelPaciente">
                    <td colspan="2"> </td>
                    <td colspan="1"> </td>
                </tr>
                <tr class="InformacionDelPaciente">
                     <td colspan="3"> </td>
                </tr>
                <tr class="InformacionDelPaciente">
                     <td colspan="3">  </td>
                </tr>
                <tr class="InformacionDelPaciente">
                     <td colspan="3">  </td>
                </tr>
            </table>

          
</body>

</html>