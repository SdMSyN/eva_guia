<?php
    session_start();
    include ('../config/conexion.php');
    $user = $_POST['inputUser'];
    $pass = $_POST['inputPass'];
    
    $cadErr = '';
    $ban =false;
    $perfil = 0;
    
    $sqlGetUser = "SELECT $tUsers.id as id, $tUsers.informacion_id as idInfo, "
            . "$tUsers.nombre as name, $tUsers.banco_nivel_escolar_id, $tUsers.perfil_id, $tInfo.foto_perfil "
            . "FROM $tUsers "
            . "INNER JOIN $tInfo ON $tInfo.id=$tUsers.informacion_id "
            . "WHERE BINARY $tUsers.user='$user' AND BINARY $tUsers.pass='$pass' AND $tUsers.activo='1' ";
    $resGetUser=$con->query($sqlGetUser);
    if($resGetUser->num_rows > 0){
        $rowGetUser=$resGetUser->fetch_assoc();
        $_SESSION['sessU'] = true;
        $_SESSION['userId'] = $rowGetUser['id'];
        $_SESSION['userName'] = $rowGetUser['name'];
        $_SESSION['nivelEsc'] = $rowGetUser['banco_nivel_escolar_id'];
        $_SESSION['perfil'] = $rowGetUser['perfil_id'];
        $_SESSION['fotoPerfil'] = $rowGetUser['foto_perfil'];
        $perfil = $rowGetUser['perfil_id'];
        $ban = true;
    }
    else{ 
        $_SESSION['sessU']=false;
        $cadErr = "Usuario incorrecto";
        $ban = false;
    }
                        
    if($ban){
        echo json_encode(array("error"=>0, "perfil"=>$perfil));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$cadErr));
    }
?>