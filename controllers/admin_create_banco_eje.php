<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idMat = $_POST['inputMat'];
    $name = $_POST['inputName'];
    $msg = '';
    
    $sqlAddMat = "INSERT INTO $tBEjes (nombre, banco_materia_id, creado) "
            . "VALUES ('$name', '$idMat', '$dateNow') ";
    if($con->query($sqlAddMat) === TRUE){
        $msg = "Eje añadido con éxito.";
        echo json_encode(array("error"=>0, "msgErr"=>$msg));
    }else{
        $msg = "No se pudo añadir el eje -> ".$con->error;
        echo json_encode(array("error"=>1, "msgErr"=>$msg));
    }

?>