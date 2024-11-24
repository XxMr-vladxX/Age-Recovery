<?php
    include ('conexion.php');
    include ('funciones.php');
    $conn = connection();
    session_start();
    $IdMedico = $_SESSION['IdMedico'];



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
            <th><img src="Logo.png" height="90" width="90" alt="..."></th> 
            <th colspan="2">Bienvenido: <?php echo $_SESSION['nombre']; ?></th> 
        </tr> 
    </thead> 
    <tbody> 
        <tr> 
            <th colspan="3">Tipos De Reportes</th> 
        </tr>
        <tr class="Boton2"> 
        <td colspan="3"> 
                <form class="BotonesReportes" method="POST" action="../Reportes/ReporteDeEnfermedades.php">
                    <input type="submit" name="boton" class="btn btn-primary" value="Enfermedades Similares" style="width: 100%; height: 100%;"> 
                    <label for="Enfermedad">Elige una Enfermedad:</label>
                <select name="Enfermedad" id="Enfermedad" class="custom-select">
                 <option value="Gastritis">Gastritis</option>
                 <option value="Migraña">Migraña</option>
                 <option value="Diabetes">Diabetes</option>
                 </select>
                </form>
             </td>
        </tr> 

        <tr class="EspacioMiniReportes">
            <td colspan="3"></td>
        </tr>

        <tr class="Boton2"> 
        <td colspan="3"> 
                <form class="BotonesReportes" method="POST" action="../Reportes/ReporteGenero.php">
                <input type="submit" name="boton" class="btn btn-primary" value="Reporte Por Genero" style="width: 100%; height: 100%;"> 
                <label for="Genero">Elige un Genero:</label>
                <select name="Genero" id="Genero" class="custom-select">
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
                <form class="BotonesReportes" method="POST" action="../Reportes/ReporteTopPacientes.php">
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
                    <th colspan="4">
                        ELIGE UN <br>
                        REPORTE
                    </th>
                </tr>
                <tr class="SubtituloPaciente">
                    <td colspan="4"> Informacion De los Pacientes </td>
                </tr>
            </table>

          
</body>

</html>
