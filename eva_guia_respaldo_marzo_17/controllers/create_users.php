<?php

    include('../config/conexion.php');
    include('../config/variables.php');

    for($i = 1; $i < 600; $i++){
        $user = "secu".$i;
        $pass = generar_clave(10);
        $sqlInsertInfo = "INSERT INTO $tInfo (foto_perfil, creado, actualizado) "
            . "VALUES ('$fotoPerfil', '$dateNow', '$dateNow') ";
        if($con->query($sqlInsertInfo) === TRUE){
            $idInfo = $con->insert_id;
            $sqlInsertAlum = "INSERT INTO $tUsers "
                . "(nombre, user, pass, clave, informacion_id, banco_nivel_escolar_id, perfil_id, activo, creado, actualizado) "
                . "VALUES "
                . "('Estudiante', '$user', '$pass', '$user', '$idInfo', '2', '3', '0', '$dateNow', '$dateNow') ";
            if($con->query($sqlInsertAlum) === TRUE){
                echo $user.' - '.$pass.'<br>';  
            }else{
                echo 'Error al insertar estudiante.'.$con->error;
            }
        }
        
    }
    
    function generar_clave($longitud){ 
       $cadena="[^0-9]"; 
       return substr(eregi_replace($cadena, "", md5(rand())) . 
        eregi_replace($cadena, "", md5(rand())) . 
        eregi_replace($cadena, "", md5(rand())), 
        0, $longitud); 
    }

?>