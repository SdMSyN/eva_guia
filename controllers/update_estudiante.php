<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idAlumno = $_POST['inputIdUser'];
    $name = $_POST['inputName'];
    
    $msgErr = '';
    $ban = true;
    
    $sqlUpdateAlumno = "UPDATE $tUsers SET nombre='$name', actualizado='$dateNow' WHERE id='$idAlumno' ";
    if($con->query($sqlUpdateAlumno) === TRUE){
        $ban = true;
        $msgErr = 'Estudiante actualizado con éxito';
    }else{
        $ban = false;
        $msgErr = 'Error al actualizar estudiante.<br>'.$con->error;
    }

    if($ban){
        echo json_encode(array("error"=>0, "msgErr"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
    
?>