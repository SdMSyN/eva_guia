<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idUser = $_POST['idUser'];
    $name = (isset($_POST['inputName'])) ? $_POST['inputName'] : '';
    $esc = (isset($_POST['inputEsc'])) ? $_POST['inputEsc'] : '';
    $mail = (isset($_POST['inputMail'])) ? $_POST['inputMail'] : '';
    $cel = (isset($_POST['inputCel'])) ? $_POST['inputCel'] : '';
    
    $msgErr = '';
    $ban = true;
    
    $sqlGetIdInfo = "SELECT informacion_id FROM $tUsers WHERE id='$idUser' ";
    $resGetIdInfo = $con->query($sqlGetIdInfo);
    $rowGetIdInfo = $resGetIdInfo->fetch_assoc();
    $idInfo = $rowGetIdInfo['informacion_id'];
    
    if($name != ''){
        $sqlUpdateName = "UPDATE $tUsers SET nombre='$name' WHERE id='$idUser' ";
        if($con->query($sqlUpdateName) === TRUE){
            $ban = true;
            $msgErr .= 'Nombre actualizado con éxito.';
        }else{
            $ban = false;
            $msgErr .= 'Error: Al actualizar nombre.';
        }
    }
    if($esc != '' || $mail != '' && $cel != ''){
        $cadSqlUpd = "UPDATE $tInfo SET actualizado='$dateNow' ";
        if($esc != '') $cadSqlUpd .= ", escuela_id='$esc'";
        if($mail != '') $cadSqlUpd .= ", correo='$mail'";
        if($cel != '') $cadSqlUpd .= ", celular='$cel'";
        $cadSqlUpd .= " WHERE id='$idInfo' ";
        if($con->query($cadSqlUpd) === TRUE){
            $ban = true;
            $msgErr .= 'Información actualizada con éxito.';
        }else{
            $ban = false;
            $msgErr .= 'Error: Al actualizar información.';
        }
    }

    if($ban){
        echo json_encode(array("error"=>0, "msgErr"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
    
?>