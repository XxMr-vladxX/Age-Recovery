<?php
    function HorarioCita($con, $hora, $IdMedico){
        $conn = $con;
        $IdPaciente = null;
        $Estatus = null;
        $IdCita =null;
        while (mysqli_next_result($conn));
        $LlamarCita = "CALL SeleccionarHoraCita('$IdMedico', '$hora')";
        $query = mysqli_query($conn, $LlamarCita);
    
        if ($query) {
        while ($row = mysqli_fetch_array($query)) {
            $IdPaciente = $row['idPaciente'];
            $Estatus = $row['Estatus'];
            $IdCita = $row['id_Cita'];
        }
        mysqli_free_result($query);
        }else {
        echo "n/a";
        exit; 
        }
        while (mysqli_next_result($conn));
        $NombrePaciente = "call Paciente('$IdPaciente')";
        $query2 = mysqli_query($conn, $NombrePaciente);
        if ($query2) {
        $row2 = mysqli_fetch_array($query2);
        $Paciente = $row2; 
        mysqli_free_result($query2); 
        } else {
        echo "n/a";
        }

        if($IdPaciente != null){
            $datos = array(
                "IdPaciente" => $IdPaciente,
                "Estatus" => $Estatus, 
                "Paciente" => $Paciente,
                "IdCita" => $IdCita
            );
        }else{
            $datos = array(
                "IdPaciente" => "n/a",
                "Estatus" => "Inactivo", 
                "Paciente" => array(  
                    "nombre" => "n/a",   
                ),
                "IdCita" => "n/a"
            );
        }
        return $datos;
    }

    function InformacionCita($con, $IdCita){
        $conn = $con;
        if($IdCita != "n/a"){
            while (mysqli_next_result($conn));
            $NombrePaciente = "call Cita('$IdCita')";
            $query2 = mysqli_query($conn, $NombrePaciente);
            if ($query2) {
            $row2 = mysqli_fetch_array($query2);
            if(mysqli_num_rows($query2) > 0){
                $Paciente = $row2; 
            }else{
                $Paciente = array(
                    "id_Cita" => "n/a",
                    "idPaciente" => "n/a",
                    "idMedico" => "n/a",
                    "Fecha" => "n/a",
                    "Hora" => "n/a",
                    "FechaCancelacion" => "n/a",
                    "Observaciones" => "n/a",
                    "FechaRegistro" => "n/a ",
                    "Estatus" => "Inactivo"
                );
            }
            mysqli_free_result($query2); 
            } else {
            echo "n/a";
            }
            return $Paciente;
        }else{
            $Paciente = array(
                "id_Cita" => "n/a",
                "idPaciente" => "n/a",
                "idMedico" => "n/a",
                "Fecha" => "n/a",
                "Hora" => "n/a",
                "FechaCancelacion" => "n/a",
                "Observaciones" => "n/a",
                "FechaRegistro" => "n/a ",
                "Estatus" => "Inactivo"
            );
            return $Paciente;
        }
    }

    function InformacionPaciente($con, $IdPaciente){
        $conn = $con;
        if($IdPaciente != "n/a"){
            while (mysqli_next_result($conn));
            $NombrePaciente = "call Paciente('$IdPaciente')";
            $query2 = mysqli_query($conn, $NombrePaciente);
            if ($query2) {
            $row2 = mysqli_fetch_array($query2);
            $Paciente = $row2; 
            mysqli_free_result($query2); 
            } else {
            echo "n/a";
            }
            return $Paciente;
        }else{
            $Paciente = array(
                "IdPaciente" => "n/a",
                "nombre" => "n/a",
                "apellido" => "n/a",
                "fechaNacimiento" => "n/a",
                "sexo" => "n/a",
                "TipoDeSangre" => "n/a",
                "peso" => "n/a",
                "estatura" => "n/a",
                "direccion" => "n/a",
                "CorreoElectronico" => "n/a",
                "contrasena" => "n/a",
                "telefono" => "n/a",
                "enfermedades" => "n/a",
                "alergias" => "n/a",
                "Cirugias_Accidentes" => "n/a",
                "Estatus" => "n/a"
            );
            return $Paciente;
        }
    }


    function InformacionMedico($con, $IdMedico){
        $conn = $con;
        if($IdMedico != "n/a"){
            while (mysqli_next_result($conn));
            $NombrePaciente = "call Medico('$IdMedico')";
            $query2 = mysqli_query($conn, $NombrePaciente);
            if ($query2) {
            $row2 = mysqli_fetch_array($query2);
            $Paciente = $row2; 
            $query2->free();
            } else {
            echo "n/a";
            }
            return $Paciente;
        }else{
            $Paciente = array(
                "IdMedico" => "n/a",
                "nombre" => "n/a",
                "CedulaProfesional" => "n/a",
                "especialidad" => "n/a",
                "telefono" => "n/a",
                "correo" => "n/a"
            );
            return $Paciente;
        }
    }




    function ReporteTopCancelan($con, $IdMedico){
        $conn = $con;
        if($IdMedico != "n/a"){
            while (mysqli_next_result($conn));
            $NombrePaciente = "call PacientesCancelan($IdMedico);";
            $query2 = mysqli_query($conn, $NombrePaciente);
            if ($query2) {
            $row2 = mysqli_fetch_array($query2);
            $Paciente = $row2; 
            $query2->free();
            } else {
            echo "n/a";
            }
            return $Paciente;
        }else{
            $Paciente = array(
                "IdMedico" => "n/a",
                "nombre" => "n/a",
                "CedulaProfesional" => "n/a",
                "especialidad" => "n/a",
                "telefono" => "n/a",
                "correo" => "n/a"
            );
            return $Paciente;
        }
    }


   
?>