<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idEje = $_POST['inputEje'];
    $name = $_POST['inputName'];
    $msg = '';
    
    $sqlAddMat = "INSERT INTO $tBNivs (nombre, banco_eje_id, creado) "
            . "VALUES ('$name', '$idEje', '$dateNow') ";
    if($con->query($sqlAddMat) === TRUE){
        $msg = "Nivel añadido con éxito.";
        echo json_encode(array("error"=>0, "msgErr"=>$msg));
    }else{
        $msg = "No se pudo añadir el nivel -> ".$con->error;
        echo json_encode(array("error"=>1, "msgErr"=>$msg));
    }

?>