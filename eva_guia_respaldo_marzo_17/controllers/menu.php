<?php

    if(isset($_SESSION['sessU'])  AND $_SESSION['sessU'] == "true"){
        $cadMenuNavbar='';
        if($_SESSION['perfil'] == "1"){//Administrador
            $cadMenuNavbar .= '<li><a href="index_admin.php">Menú Administrador</a></li>';
            $cadMenuNavbar .= '<li><a href="admin_read_banco_niveles_escolares.php">Bancos</a></li>';
            $cadMenuNavbar .= '<li><a href="admin_read_estudiantes.php">Estudiantes</a></li>';
        } else if($_SESSION['perfil'] == "3"){//Alumno
            $cadMenuNavbar .= '<li><a href="index_estudiante.php">Menú Alumno</a></li>';
            $cadMenuNavbar .= '<li><a href="est_programa.php">Programa</a></li>';
        }else{
            $cadMenuNavbar .= '<li>¿Cómo llegaste hasta acá?</li>';
        }
        echo $cadMenuNavbar;
    }
	
?>