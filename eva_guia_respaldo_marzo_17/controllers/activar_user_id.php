<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $id = $_GET['id'];
    $sqlActivar = "UPDATE $tUsers SET activo='1', actualizado='$dateNow' WHERE id='$id' ";
    echo $sqlActivar.'<br>';
    if($con->query($sqlActivar) === TRUE){
        echo 'Exito. <a href="activar_user.php">Regresar</a>';
    }else{
        echo "Error: Activación no posible, usuario ID: $id";
    }
    
?>