<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $eje = array();
    $msgErr = '';
    $ban = false;
    
    $idMat = $_GET['idMat'];
    
    $sqlGetEje = "SELECT * FROM $tBEjes WHERE banco_materia_id='$idMat' ";
    
    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
        $sqlGetEje .= " ORDER BY ".$vorder;
    }
                
    $resGetEje = $con->query($sqlGetEje);
    if($resGetEje->num_rows > 0){
        while($rowGetEje = $resGetEje->fetch_assoc()){
            $id = $rowGetEje['id'];
            $name = $rowGetEje['nombre'];
            $created = $rowGetEje['creado'];
            $eje[] = array('id'=>$id, 'nombre'=>$name, 'creado'=>$created);
            $ban = true;
        }
    }else{
        $ban = false;
        $msgErr = 'No existen ejes en esta materia   （┬┬＿┬┬） '.$con->error;
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$eje));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>