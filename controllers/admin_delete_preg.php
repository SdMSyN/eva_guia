<?php

    include('../config/conexion.php');
    include('../config/variables.php');

    $idPreg = $_GET['idPreg'];
    $ban = false;
    $banTmp = false;
    $msgErr = '';
    //borramos respuestas de la pregunta
    $sqlDeleteResps = "DELETE FROM $tBResps WHERE banco_pregunta_id='$idPreg' ";
    if($con->query($sqlDeleteResps) === TRUE){
        $sqlDeletePreg = "DELETE FROM $tBPregs WHERE id='$idPreg' ";
        if($con->query($sqlDeletePreg) === TRUE){
            $ban = true;
        }else{
            $banTmp = false;
            $msgErr .= 'Error al eliminar pregunta.<br>'.$con->error;
        }
    }else{
        $ban = false;
        $msgErr .= 'Error al eliminar respuestas de la pregunta<br>.'.$con->error;
    }
      
    if($ban){
        $msgErr = 'Se borro con éxito.';
        echo json_encode(array("error"=>0, "dataRes"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "dataRes"=>$msgErr));
    }
?>