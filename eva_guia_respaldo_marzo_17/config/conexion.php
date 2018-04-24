<?php
	
    date_default_timezone_set('America/Mexico_City');
    $host="localhost";
    $user="root";
    $pass="";
    $db="eva_guia";
    $con=mysqli_connect($host, $user, $pass, $db);
    if($con->connect_error){
            die("Connection failed: ".$con->connect_error);
    }
    //echo 'Hola';

    //Tablas Usuarios
        $tUsers = "usuarios";
        $tUPerfil = "usuarios_perfil";
        $tInfo = "usuarios_informacion";
    
    //Tablas de Banco
        $tBNivEsc = "banco_niveles_escolares";
        $tBMat = "banco_materias";
        $tBEjes = "banco_ejes";
        $tBNivs = "banco_niveles";
        $tBPregs = "banco_preguntas";
        $tBResps = "banco_respuestas";
        
    //Tablas de resultados del estudiante
        $tExaTmp = "exa_respuestas_tmp";
        $tScoreE = "score_examenes";
        $tScoreEj = "score_ejercicios";
        $tExeTmp = "eje_respuestas_tmp";

        
?>