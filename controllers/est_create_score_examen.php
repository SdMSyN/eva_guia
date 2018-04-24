<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
        
    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idUser = $_GET['idUser'];
    $idNivel = $_GET['idNivel'];
    //echo $idUser.'--'.$idExam;
    
    $msgEx = '';
    $cadCheck = '';
    $countPregs = 0;
    $numSinResp = 0;
    $valorEst = 0;
    $valorExam = 0;
    $arrCalRespTmp = array();
    $arrSqls = array();
    $arrResp = array();
    
    //Buscar las preguntas respondidas en la tabls resultados_tmp coincidiendo nivel y usuario
    //Buscar si la respuesta es correcta o incorrecta
    //Eliminar respuestas temporales
    $ban = true;
    $msgErr = '';
    $score = 0;
    $numPregs = 3;
    $numCorr = 0; 
    $numErr = 0;
    $sqlGetRespTmp = "SELECT * FROM $tExaTmp WHERE estudiante_id='$idUser' AND banco_nivel_id='$idNivel' ";
    $resGetRespTmp = $con->query($sqlGetRespTmp);
    if($resGetRespTmp->num_rows > 0){
        while($rowGetRespTmp = $resGetRespTmp->fetch_assoc()){
            $idRespTmp = $rowGetRespTmp['id'];
            $idPreg = $rowGetRespTmp['banco_pregunta_id'];
            $idResp = $rowGetRespTmp['banco_respuesta_id'];
            $sqlGetRespCorr = "SELECT correcta FROM $tBResps WHERE banco_pregunta_id='$idPreg' AND id='$idResp' ";
            $resGetRespCorr = $con->query($sqlGetRespCorr);
            $rowGetRespCorr = $resGetRespCorr->fetch_assoc();
            if($rowGetRespCorr['correcta'] == 1){
                $numCorr++;
                $score++;
            }else{
                $numErr++;
            }
            $sqlDeleteRespTmp = "DELETE FROM $tExaTmp WHERE id='$idRespTmp' ";
            if($con->query($sqlDeleteRespTmp) === TRUE){
                $ban = true;
                continue;
            }else{
                $ban = false;
                $msgErr .= 'Error: No se pudo eliminar resultado temporal.';
                break;
            }
        }
    }
    
    if($ban){// Si no hay error guardamos score
        //Buscamos si este alumno no ha respondido éste nivel, si no insertamos, si si ctualizamos.
        //Si actualizamos solo si el score es mayor al anterior
        $sqlGetIdScore = "SELECT id, score, num_intentos FROM $tScoreE WHERE estudiante_id='$idUser' AND banco_nivel_id='$idNivel' ";
        $resGetIdScore = $con->query($sqlGetIdScore);
        if($resGetIdScore->num_rows > 0){//si existe, actualiza
            $rowGetScore = $resGetIdScore->fetch_assoc();
            $idScore = $rowGetScore['id'];
            $scoreScore = $rowGetScore['score'];
            $numIntScore = $rowGetScore['num_intentos'];
            $numInt = $numIntScore + 1;
            if($score > $scoreScore){//actualizamos score y numIntentos
                $updateScore = "UPDATE $tScoreE SET score='$score', num_intentos='$numInt', actualizado='$dateNow $timeNow' "
                        . "WHERE id='$idScore' ";
                if($con->query($updateScore) === TRUE){
                    $ban = true;
                    $msgErr .= 'Exito al actualizar score';
                }else{
                    $ban = false;
                    $msgErr .= 'Error: No se pudo actualizar el score.';
                }
            }else{//actualizamos solo el numIntentos
                $updateScoreNumInt = "UPDATE $tScoreE SET num_intentos='$numInt', actualizado='$dateNow $timeNow' "
                        . "WHERE id='$idScore' ";
                if($con->query($updateScoreNumInt) === TRUE){
                    $ban = true;
                    $msgErr .= 'Exito al actualizar numInts';
                }else{
                    $ban = false;
                    $msgErr .= 'Error: No se pudo actualizar el número de intentos.';
                }
            }
        }else{//no existe, crea
            $sqlInsertScore = "INSERT INTO $tScoreE "
                    . "(estudiante_id, score, banco_nivel_id, num_intentos, creado, actualizado) "
                    . "VALUES ('$idUser', '$score', '$idNivel', '1', '$dateNow', '$dateNow') ";
            if($con->query($sqlInsertScore) === TRUE){
                $ban = true;
            }else{
                $ban = false;
                $msgErr .= 'Error: No se pudo crear el score nuevo.';
            }
        }
		
		$sqlInsertBit = "INSERT INTO $tBBitExe (estudiante_id, score, banco_nivel_id, creado) VALUES ('$idUser', '$score', '$idNivel', '$dateNow $timeNow')";
		if($con->query($sqlInsertBit) === TRUE){
			$ban = true;
		}else{
			$ban = false;
			$msgErr .= 'Error: No se pudo insertar la bitacora';
		}
    }
    
    if($ban){
        $msgErr .= 'Éxito al guardar tu score';
        echo json_encode(array("error"=>0, "dataRes"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "dataRes"=>$msgErr));
    }
    
?>