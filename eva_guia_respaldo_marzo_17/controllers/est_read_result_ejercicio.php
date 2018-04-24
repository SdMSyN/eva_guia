<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $data = array();
    $msgErr = '';
    $ban = false;
    $numPregs = 10; 
    
    $idNivel = $_GET['idNivel'];
    $idUser = $_GET['idUser'];
    
    $sqlGetResult = "SELECT * FROM $tScoreEj WHERE estudiante_id='$idUser' AND banco_nivel_id='$idNivel' ";
                
    $resGetResult = $con->query($sqlGetResult);
    if($resGetResult->num_rows > 0){
        while($rowGetResult = $resGetResult->fetch_assoc()){
            //$cadRes .= '<option value="'.$rowGetMateria['id'].'">'.$rowGetMateria['nombre'].'</option>';
            $id = $rowGetResult['id'];
            $score = $rowGetResult['score'];
            $numInt = $rowGetResult['num_intentos'];
            $inco = $numPregs-$score;
            $porc = ($score*10).' %';
            $data[] = array('id'=>$id, 'score'=>$score, 'numInt'=>$numInt, 'numPregs'=>$numPregs, 'inco'=>$inco, 'porc'=>$porc);
            $ban = true;
        }
    }else{
        $ban = false;
        $msgErr = 'No existen ejercicios en el examen   （┬┬＿┬┬） '.$con->error;
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$data));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>