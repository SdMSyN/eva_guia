<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $eje = array();
    $msgErr = '';
    $ban = false;
    
    $idNivel = $_GET['idNivel'];
    
    $sqlGetPregs = "SELECT * FROM $tBPregs WHERE banco_nivel_id='$idNivel' ";
    
    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
        $sqlGetPregs .= " ORDER BY ".$vorder;
    }
                
    $resGetPregs = $con->query($sqlGetPregs);
    if($resGetPregs->num_rows > 0){
        while($rowGetPregs = $resGetPregs->fetch_assoc()){
            $id = $rowGetPregs['id'];
            $name = $rowGetPregs['nombre'];
            $created = $rowGetPregs['creado'];
            $eje[] = array('id'=>$id, 'nombre'=>$name, 'creado'=>$created);
            $ban = true;
        }
    }else{
        $ban = false;
        $msgErr = 'No existen preguntas en este nivel   （┬┬＿┬┬） '.$con->error;
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$eje));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>