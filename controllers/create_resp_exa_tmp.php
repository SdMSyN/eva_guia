<?php

    include('../config/conexion.php');
    include('../config/variables.php');
   
    $idUser = $_POST['idUser'];
    $idNivel = $_POST['idNivel'];
    $idPreg = $_POST['idPreg'];
    $resp = (isset($_POST['resp'])) ? $_POST['resp'] : null;//según tipo de respuesta validar para leer valores
    //echo $idUser.'--'.$idExam.'--'.$idExamAsigAlum.'--'.$idPreg.'--'.$tipoResp.'--'.$resp;
    $ban = true;
    $msgErr = '';
    if($resp != null){//si hay algo en la respuesta haz algo, si no nada
        $sqlGetRespTmp = "SELECT id FROM $tExaTmp "
                . "WHERE estudiante_id='$idUser' AND banco_nivel_id='$idNivel' "
                . "AND banco_pregunta_id='$idPreg' ";
        $resGetIdRespTmp = $con->query($sqlGetRespTmp);
        if($resGetIdRespTmp->num_rows > 0){ //si existe la respuesta, actualiza
            $rowGetIdRespTmp = $resGetIdRespTmp->fetch_assoc();
            $idRespTmp = $rowGetIdRespTmp['id'];
            $sqlUpdateRespTmp = "UPDATE $tExaTmp SET banco_respuesta_id='$resp' WHERE id='$idRespTmp' ";
            if($con->query($sqlUpdateRespTmp) != TRUE){
                $ban = false;
                $msgErr .= 'Error al actualizar temporalmente tu respuesta.<br>'.$con->error;
            }else{
                echo "Éxito al actualizar respuesta temporal";
            }
        }else{//si no existe la respuesta inserta
            $sqlInsertRespTmp = "INSERT INTO $tExaTmp (estudiante_id, banco_nivel_id, banco_pregunta_id, banco_respuesta_id, creado) "
                    . "VALUES ('$idUser', '$idNivel', '$idPreg', '$resp', '$dateNow')";
            if($con->query($sqlInsertRespTmp) != TRUE){
                $ban = false;
                $msgErr .= 'Error al guardar temporalmente tu respuesta.<br>'.$con->error;
            }else{
                echo "Éxito al guardar respuesta temporal";
            }
        }
    }
    
    
?>