<?php

    include('../config/conexion.php');
    include('../config/variables.php');

    $idAlum = $_GET['idAlum'];
    $ban = false;
    $banTmp = false;
    $msgErr = '';
    //borramos información del alumno
    $sqlGetIdInfo = "SELECT informacion_id FROM $tUsers WHERE id='$idAlum' ";
    $resGetIdInfo = $con->query($sqlGetIdInfo);
    if($resGetIdInfo->num_rows > 0){
        $rowGetIdInfo = $resGetIdInfo->fetch_assoc();
        $idInfo = $rowGetIdInfo['informacion_id'];
        
        $sqlDeleteAlum = "DELETE FROM $tUsers WHERE id='$idAlum' ";
        if($con->query($sqlDeleteAlum) === TRUE){
            $sqlDeleteInfo = "DELETE FROM $tInfo WHERE id='$idInfo' ";
            if($con->query($sqlDeleteInfo) === TRUE){
                $ban = true;
            }else{
                $banTmp = false;
                $msgErr .= 'Error al eliminar información del estudiante.<br>'.$con->error;
            }
        }else{
            $ban = false;
            $msgErr .= 'Error al borrar estudiante.'.$con->error;
        }
    }else{
        $ban = false;
        $msgErr .= 'Error al buscar información del estudiante.';
    }
            
    if($ban){
        $msgErr = 'Se borro con éxito.';
        echo json_encode(array("error"=>0, "dataRes"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "dataRes"=>$msgErr));
    }
?>