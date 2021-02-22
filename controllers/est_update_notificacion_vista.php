<?php
    include ('../config/conexion.php');
    include('../config/variables.php');
    
    $idAv = $_GET['idAv'];

    $msgErr = '';
    $ban = true;
    
    $sqlUpdateAv = "UPDATE notificacionRlAvisoAlumno SET enterado = 1, fecha_enterado = NOW() WHERE id_notificacionRlAvisoAlumno = $idAv ";
    if($con->query($sqlUpdateAv) === TRUE){
        $ban = true;
    }else{
        $ban = false;
        $msgErr .= 'Error al actualizar aviso asignación.'.$con->error;
    }
    

    if($ban){
        echo json_encode(array("error"=>0));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
?>