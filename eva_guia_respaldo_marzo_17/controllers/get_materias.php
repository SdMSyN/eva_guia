<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $materia = array();
    $msgErr = '';
    $ban = false;
    
    $idNivel = $_GET['idNivel'];
    
    $sqlGetMateria = "SELECT * FROM $tBMat WHERE banco_nivel_escolar_id='$idNivel' ";
    
    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
        $sqlGetMateria .= " ORDER BY ".$vorder;
    }
                
    $resGetMateria = $con->query($sqlGetMateria);
    if($resGetMateria->num_rows > 0){
        while($rowGetMateria = $resGetMateria->fetch_assoc()){
            //$cadRes .= '<option value="'.$rowGetMateria['id'].'">'.$rowGetMateria['nombre'].'</option>';
            $id = $rowGetMateria['id'];
            $name = $rowGetMateria['nombre'];
            $created = $rowGetMateria['creado'];
            $materia[] = array('id'=>$id, 'nombre'=>$name, 'creado'=>$created);
            $ban = true;
        }
    }else{
        $ban = false;
        $msgErr = 'No existen materias   （┬┬＿┬┬） '.$con->error;
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$materia));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>