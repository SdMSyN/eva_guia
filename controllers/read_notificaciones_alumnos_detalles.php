<?php
    include ('../config/conexion.php');
    include('../config/variables.php');
    
    $idAv = $_GET['idAv'];

    $msgErr = '';
    $ban = true;
    $arrNot = array();
    
    $sqlGetAvInfo = "SELECT 
                        notificacionRlAvisoAlumno.id_notificacionRlAvisoAlumno AS Id,
                        notificacionRlAvisoAlumno.enterado,
                        notificacionRlAvisoAlumno.fecha_enterado,
                        usuarios.nombre AS nombreAlum
                    FROM notificacionRlAvisoAlumno
                        INNER JOIN usuarios ON notificacionRlAvisoAlumno.id_usuarios = usuarios.id
                    WHERE notificacionRlAvisoAlumno.id_notificacionTrAviso = $idAv ";

    $resGetAvInfo = $con->query($sqlGetAvInfo);
    if($resGetAvInfo->num_rows > 0){
        while($rowGetAvInfo = $resGetAvInfo->fetch_assoc()){
            $idAvAsig            = $rowGetAvInfo['Id'];
            $nameAlum            = $rowGetAvInfo['nombreAlum'];
            $enteradoAvAsig      = $rowGetAvInfo['enterado'];
            $enteradoFechaAvAsig = $rowGetAvInfo['fecha_enterado'];
            $arrNot[] = array( 'id' => $idAvAsig, 'nombre' => $nameAlum, 
                'enterado' => $enteradoAvAsig, 'fechaEnterado' => $enteradoFechaAvAsig );
        }
    } else {
        $ban = false;
        $msgErr .= 'No notificaste a los alumnos.';
    }

    if($ban){
        echo json_encode( array( "error" => 0, "dataRes" => $arrNot ) );
    }else{
        echo json_encode( array( "error" => 1, "msgErr" => $msgErr ) );
    }
?>