<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idUser = $_GET['idUser'];
    
    $msgErr = '';
    $res = true;
    $ban = true;
    
    $sqlReadInfo = "SELECT $tInfo.correo, $tInfo.celular, $tInfo.escuela_id "
            . "FROM $tUsers "
            . "INNER JOIN $tInfo ON $tInfo.id=$tUsers.informacion_id "
            . "WHERE $tUsers.id='$idUser' ";
    $resReadInfo = $con->query($sqlReadInfo);
    if($resReadInfo->num_rows > 0){
        $rowReadInfo = $resReadInfo->fetch_assoc();
        $mail = $rowReadInfo['correo'];
        $cel = $rowReadInfo['celular'];
        $escId = $rowReadInfo['escuela_id'];
        if($mail == NULL || $cel == NULL || $escId == NULL){
            $res = false;
        }else{
            $res = true;
        }
    }else{
        $ban = false;
        $msgErr .= 'Error: No existe éste usuario.';
    }

    if($ban){
        echo json_encode(array("error"=>$res, "msgErr"=>$msgErr));
    }else{
        echo json_encode(array("error"=>$res, "msgErr"=>$msgErr));
    }
    
?>