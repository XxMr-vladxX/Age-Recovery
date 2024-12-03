<?php
session_start();
include('conexion.php');
$conn = connection();

$IdPaciente = $_SESSION['IdPaciente'];
// Obtener todos los pacientes (si se desea un paciente específico, deberías pasar el IdPaciente)
$consultar = "SELECT * FROM pacientes where IdPaciente = '$IdPaciente'";
$result = mysqli_query($conn, $consultar);
while($row = mysqli_fetch_array($result)):
   
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="perfilpacientestyle.css">
    <title>Perfil</title>
    <script>
    function validarTelefono() {
        var telefono = document.getElementsByName('telefono')[0].value;
        var regex = /^[0-9]+$/;  // Solo números

        if (!regex.test(telefono)) {
            alert("El teléfono debe contener solo números.");
            return false; // Evita el envío del formulario
        }
        return true; // Permite el envío del formulario
    }
</script>
</head>
<body>
    <div class="hero">
        <nav>
            <img src="Logo.png" class="logo">
            <ul>
                <li><a href="inicio2.php">Inicio</a></li>
                <li><a href="formulario.php">Agendar Cita</a></li>
                <!-- Cambio realizado: Enlace 'Tus citas!' ahora conecta con eliminar.php y pasa el IdPaciente -->
                <li><a href="eliminar.php">Tus citas!</a></li>
                <!-- Fin del cambio -->
            </ul>
        </nav><br>
        <h1>Bienvenid@, <?php echo $row['nombre']; ?></h1>
        <section id="contacto">
            <div class="formulario">
                <h1>Información del Paciente</h1>
                <form method="post" action="modificar.php" onsubmit="return validarTelefono()">
                    <input type="hidden" name="IdPaciente" value="<?php echo $IdPaciente; ?>">
                    <table>
                        <tr>
                            <td><label>Nombre</label></td>
                            <td><input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required></td>
                            <td><label>Estatura en mts</label></td>
                            <td><input type="text" name="estatura" value="<?php echo $row['estatura']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><label>Apellido</label></td>
                            <td><input type="text" name="apellido" value="<?php echo $row['apellido']; ?>" required></td>
                            <td><label>Teléfono</label></td>
                            <td><input type="text" name="telefono" value="<?php echo $row['telefono']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><label>Fecha de Nacimiento</label></td>
                            <td><input type="date" name="fechaNacimiento" value="<?php echo $row['fechaNacimiento']; ?>" required></td>
                            <td><label>Dirección</label></td>
                            <td><input type="text" name="direccion" value="<?php echo $row['direccion']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><label>Sexo</label></td>
                            <td>
                                <select name="sexo" required>
                                    <option value="Masculino" <?php echo ($row['sexo'] == 'masculino') ? 'selected' : ''; ?>>Masculino</option>
                                    <option value="Femenino" <?php echo ($row['sexo'] == 'femenino') ? 'selected' : ''; ?>>Femenino</option>
                                </select>
                            </td>
                            <td><label>Correo Electrónico</label></td>
                            <td><input type="email" name="CorreoElectronico" value="<?php echo $row['CorreoElectronico']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><label>Tipo de Sangre</label></td>
                            <td>
                                <select name="TipoDeSangre" required>
                                    <option value="A+" <?php echo ($row['TipoDeSangre'] == 'A+') ? 'selected' : ''; ?>>A+</option>
                                    <option value="A-" <?php echo ($row['TipoDeSangre'] == 'A-') ? 'selected' : ''; ?>>A-</option>
                                    <option value="B+" <?php echo ($row['TipoDeSangre'] == 'B+') ? 'selected' : ''; ?>>B+</option>
                                    <option value="B-" <?php echo ($row['TipoDeSangre'] == 'B-') ? 'selected' : ''; ?>>B-</option>
                                    <option value="AB+" <?php echo ($row['TipoDeSangre'] == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                                    <option value="AB-" <?php echo ($row['TipoDeSangre'] == 'AB-') ? 'selected' : ''; ?>>AB-</option>
                                    <option value="O+" <?php echo ($row['TipoDeSangre'] == 'O+') ? 'selected' : ''; ?>>O+</option>
                                    <option value="O-" <?php echo ($row['TipoDeSangre'] == 'O-') ? 'selected' : ''; ?>>O-</option>
                                </select>
                            </td>
                            <td><label>Contraseña</label></td>
                            <td><input type="password" name="contrasena" value="<?php echo $row['contrasena']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><label>Peso en KG</label></td>
                            <td><input type="text" name="peso" value="<?php echo $row['peso']; ?>" required></td>
                            <td><label>Enfermedades</label></td>
                          
                            <td>  <select name="TipoDeSangre" required>
                                    <option value="Gastritis" <?php echo ($row['enfermedades'] == 'Gastritis') ? 'selected' : ''; ?>>Gastritis</option>
                                    <option value="Migraña" <?php echo ($row['enfermedades'] == 'Migraña') ? 'Migraña' : ''; ?>>Migraña</option>
                                    <option value="Diabetes" <?php echo ($row['enfermedades'] == 'Diabetes') ? 'selected' : ''; ?>>Diabetes</option>
                                    <option value="Asma" <?php echo ($row['enfermedades'] == 'Asma') ? 'selected' : ''; ?>>Asma</option>
                                    <option value="Autismo" <?php echo ($row['enfermedades'] == 'Autismo') ? 'selected' : ''; ?>>Autismo</option>
                                    <option value="Herpes" <?php echo ($row['enfermedades'] == 'Herpes') ? 'selected' : ''; ?>>Herpes</option>
                                    <option value="Artritis" <?php echo ($row['enfermedades'] == 'Artritis') ? 'selected' : ''; ?>>Artritis</option>
                                    <option value="Otra" <?php echo ($row['enfermedades'] == 'Otra') ? 'selected' : ''; ?>>Otra</option>
                                    <option value="Ninguna" <?php echo ($row['enfermedades'] == 'Ninguna') ? 'selected' : ''; ?>>Ninguna</option>
                           </select></td>
                        </tr>
                        <tr>
                            <td><label>Cirugías</label></td>
                            <td><input type="text" name="Cirugias_Accidentes" value="<?php echo $row['Cirugias_Accidentes']; ?>" required></td>
                            <td><label>Alergias</label></td>
                            <td><input type="text" name="alergias" value="<?php echo $row['alergias']; ?>" required></td>
                        </tr>
                        <?php endwhile; ?>
                    </table>
                    <input type="submit" value="Modificar">
                </form>
            </div>
        </section>
    </div>
    <footer>
        <p>&copy; 2024 Consultorio Médico "AgeRecovery". Todos los derechos reservados.</p>
    </footer>
</body>
</html>

