<?php

    include('../config/conexion.php');
    include('../config/variables.php');

    for($i = 2501; $i <= 3000; $i++){
		$user = "secu".$i;
		$pass = generar_clave(10);
		echo $user."-".$pass."<br>";
		$sqlinsertinfo = "insert into usuarios_informacion (foto_perfil, creado, actualizado) "
			. "values ('$fotoperfil', '$datenow', '$datenow') ";
		if($con->query($sqlinsertinfo) === true){
			$idinfo = $con->insert_id;
			$sqlinsertalum = "insert into usuarios "
				. "(nombre, user, pass, clave, informacion_id, banco_nivel_escolar_id, perfil_id, activo, creado, actualizado) "
				. "values "
				. "('estudiante', '$user', '$pass', '$user', '$idinfo', '2', '3', '1', '$datenow', '$datenow') ";
			if($con->query($sqlinsertalum) === true){
				echo $user.' - '.$pass.'<br>';  
			}else{
				echo 'error al insertar estudiante.'.$con->error;
			}
		}
    }
    
    function generar_clave($longitud){ 
       $cadena="[^0-9]"; 
       return substr(preg_replace($cadena, "", md5(rand())) . 
        preg_replace($cadena, "", md5(rand())) . 
        preg_replace($cadena, "", md5(rand())), 
        0, $longitud); 
    }

?>