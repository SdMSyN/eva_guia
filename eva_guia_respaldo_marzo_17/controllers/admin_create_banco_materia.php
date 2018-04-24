<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idNivel = $_POST['inputNivel'];
    $name = $_POST['inputName'];
    $msg = '';
    
    $sqlAddMat = "INSERT INTO $tBMat (nombre, banco_nivel_escolar_id, creado) "
            . "VALUES ('$name', '$idNivel', '$dateNow') ";
    if($con->query($sqlAddMat) === TRUE){
        $msg = "Materia añadida con éxito.";
        echo json_encode(array("error"=>0, "msgErr"=>$msg));
    }else{
        $msg = "No se pudo añadir la materia -> ".$con->error;
        echo json_encode(array("error"=>1, "msgErr"=>$msg));
    }

?>