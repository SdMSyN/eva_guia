<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idUser  = $_POST['idUser'];
    $name1   = ( isset( $_POST[ 'inputName' ] ) ) ? $_POST[ 'inputName' ] : '';
    $ap      = ( isset( $_POST[ 'inputAP' ] ) )   ? $_POST[ 'inputAP' ]   : '';
    $am      = ( isset( $_POST[ 'inputAM' ] ) )   ? $_POST[ 'inputAM' ]   : '';
    $curp    = ( isset( $_POST[ 'inputCurp' ] ) ) ? $_POST[ 'inputCurp' ] : '';
    $esc     = ( isset( $_POST[ 'inputEsc' ] ) )  ? $_POST[ 'inputEsc' ]  : '';
    $mail    = ( isset( $_POST[ 'inputMail' ] ) ) ? $_POST[ 'inputMail' ] : '';
    $mailEnd = ( isset( $_POST[ 'inputMailEnd' ] ) ) ? $_POST[ 'inputMailEnd' ] : '';
    $cel     = ( isset( $_POST[ 'inputCel' ] ) )  ? $_POST[ 'inputCel' ]  : '';
    
    $name = strtoupper( $name1 ).' '.strtoupper( $ap ).' '.strtoupper( $am ); // Nombre todo a mayúsculas
    $arrMail = explode( "@", $mail );  
    // $endMail = ( $mailEnd == "1" ) ? "gmail.com" : ( $mailEnd == "2" ) ? "hotmail.com" : ( $mailEnd == "3" ) ? "outlook.com" : "icloud.com";
    if( $mailEnd == "1" )
        $endMail = "gmail.com";
    else if( $mailEnd == "2" )
        $endMail = "hotmail.com";
    else if( $mailEnd == "3" )
        $endMail = "outlook.com";
    else if( $mailEnd == "4" )
        $endMail = "icloud.com";
    else 
        $endMail = "otro";
    $letMail = $arrMail[0].'@'.$endMail;
    $msgErr = '';
    $ban = true;
    
    $sqlGetIdInfo = "SELECT informacion_id FROM $tUsers WHERE id='$idUser' ";
    $resGetIdInfo = $con->query($sqlGetIdInfo);
    $rowGetIdInfo = $resGetIdInfo->fetch_assoc();
    $idInfo = $rowGetIdInfo['informacion_id'];
    
    if($name != ''){
        $sqlUpdateName = "UPDATE $tUsers SET nombre='$name', curp = '$curp' WHERE id='$idUser' ";
        if( $con->query( $sqlUpdateName ) === TRUE ){
            $ban = true;
            $msgErr .= 'Nombre actualizado con éxito.';
        }else{
            $ban = false;
            $msgErr .= 'Error: Al actualizar nombre.';
        }
    }
    if( $esc != '' || $mail != '' && $cel != '' ){
            
        $cadSqlUpd = "UPDATE $tInfo SET actualizado='$dateNow' ";
        if( $esc != '' && $esc != 0 ) 
            $cadSqlUpd .= ", escuela_id='$esc'";
        if( $mail != '' ) 
            $cadSqlUpd .= ", correo='$letMail'";
        if( $cel != '' ) 
            $cadSqlUpd .= ", celular='$cel'";
        $cadSqlUpd .= " WHERE id='$idInfo' ";
        if( $con->query( $cadSqlUpd ) === TRUE ){
            $ban = true;
            $msgErr .= 'Información actualizada con éxito.';
        }else{
            $ban = false;
            $msgErr .= 'Error: Al actualizar información.'.$con->error;
        }
    }

    if($ban){
        echo json_encode(array("error"=>0, "msgErr"=>$msgErr, "mailend"=>$mailEnd, "sql"=>$letMail));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
    
?>