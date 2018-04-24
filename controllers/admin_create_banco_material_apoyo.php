<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idEje = $_POST['inputEje'];
    $name = $_POST['inputName'];
    $link = $_POST['inputLink'];
    $msg = '';
    
    $sqlAddMat = "INSERT INTO $tBMatApoyo (nombre, enlace, banco_eje_id, creado) "
            . "VALUES ('$name', '$link', '$idEje', '$dateNow') ";
    if($con->query($sqlAddMat) === TRUE){
        $msg = "Material de apoyo añadido con éxito.";
        echo json_encode(array("error"=>0, "msgErr"=>$msg));
    }else{
        $msg = "No se pudo añadir el material de apoyo -> ".$con->error;
        echo json_encode(array("error"=>1, "msgErr"=>$msg));
    }

?>