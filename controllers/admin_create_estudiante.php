<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $name = $_POST['inputName'];
    $ap = $_POST['inputAP'];
    $am = $_POST['inputAM'];
    $nivEsc = $_POST['inputNivEsc'];

    $ban = true;
    $msgErr = '';
    
    //Obtenemos número de registros
    $sqlGetNumAlums = "SELECT id FROM $tUsers ";
    $resGetNumAlums = $con->query($sqlGetNumAlums);
    $getNumAlums = $resGetNumAlums->num_rows;
    //Creamos clave usuario y contraseña
    $nombre = $ap.' '.$am.' '.$name;
    $apTmp = str_replace(' ', '', $ap);
    $clave = strtolower($name{0}).strtolower($apTmp).strtolower($am{0}).($getNumAlums+1);
    $clave2 = generar_clave(10);
    //Insertamos informacion
    $sqlInsertInfoAlum = "INSERT INTO $tInfo (foto_perfil, creado, actualizado) "
            . "VALUES ('$fotoPerfil', '$dateNow', '$dateNow') ";
    if($con->query($sqlInsertInfoAlum) === TRUE){
        $idInfo = $con->insert_id;
        //Insertamos alumno
        $sqlInsertAlum = "INSERT INTO $tUsers "
            . "(nombre, user, pass, clave, informacion_id, banco_nivel_escolar_id, perfil_id, activo, creado, actualizado) "
            . "VALUES "
            . "('$nombre', '$clave', '$clave2', '$clave', '$idInfo', '$nivEsc', '3', '1', '$dateNow', '$dateNow') ";
        if($con->query($sqlInsertAlum) === TRUE){
            $ban = true;   
        }else{
            $msgErr .= 'Error al insertar estudiante.'.$con->error;
            $ban = false;
        }
    }else{
        $msgErr .= 'Error al insertar información del estudiante.'.$con->error;
        $ban = false;
    }
    
    if($ban){
        echo json_encode(array("error"=>0));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
    
    //Función para generar password usuario
    // http://www.leonpurpura.com/tutoriales/generar-claves-aleatorias.html
    function generar_clave($longitud){ 
       $cadena="[^A-Z0-9]"; 
       return substr(eregi_replace($cadena, "", md5(rand())) . 
       eregi_replace($cadena, "", md5(rand())) . 
       eregi_replace($cadena, "", md5(rand())), 
       0, $longitud); 
    } 
    
?>