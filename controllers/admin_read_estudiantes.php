<?php
    include ('../config/conexion.php');
    include('../config/variables.php');

    $msgErr = '';
    $ban = true;
    $arrAlumno = array();
    
    $sqlGetEsts = "SELECT * FROM $tUsers WHERE perfil_id='3' AND activo = '1' ";
    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
        $sqlGetEsts .= " ORDER BY ".$vorder;
    }
    $resGetEsts = $con->query($sqlGetEsts);
    if($resGetEsts->num_rows > 0){
        while($rowGetEsts = $resGetEsts->fetch_assoc()){
            $id = $rowGetEsts['id'];
            $nombre = $rowGetEsts['nombre'];
            $user = $rowGetEsts['user'];
            $pass = $rowGetEsts['pass'];
            $arrAlumno[] = array('id'=>$id, 'nombre'=>$nombre, 'user'=>$user, 'pass'=>$pass);
        }
    }else{
        $ban = false;
        $msgErr .= 'No tienes estudiantes.';
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$arrAlumno));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
?>