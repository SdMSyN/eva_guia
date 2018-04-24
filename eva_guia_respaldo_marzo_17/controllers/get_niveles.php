<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $eje = array();
    $msgErr = '';
    $ban = false;
    
    $idEje = $_GET['idEje'];
    
    $sqlGetNiv = "SELECT * FROM $tBNivs WHERE banco_eje_id='$idEje' ";
    
    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
        $sqlGetNiv .= " ORDER BY ".$vorder;
    }
                
    $resGetNiv = $con->query($sqlGetNiv);
    if($resGetNiv->num_rows > 0){
        while($rowGetNiv = $resGetNiv->fetch_assoc()){
            $id = $rowGetNiv['id'];
            $name = $rowGetNiv['nombre'];
            $created = $rowGetNiv['creado'];
            $eje[] = array('id'=>$id, 'nombre'=>$name, 'creado'=>$created);
            $ban = true;
        }
    }else{
        $ban = false;
        $msgErr = 'No existen niveles en esta materia   （┬┬＿┬┬） '.$con->error;
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$eje));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>