<?php
    session_start();
    include('../config/conexion.php');
    include('../config/variables.php');
    
    //include('pagination.php');
    $idPreg = $_GET['idPreg'];
    $pregs = array();
    $resps = array();

    $sqlGetInfo = "SELECT id, nombre, archivo  "
            . "FROM $tBPregs WHERE id='$idPreg' ";
    $resGetInfo = $con->query($sqlGetInfo);
    while($rowGetInfo = $resGetInfo->fetch_assoc()){
        $idPreg = $rowGetInfo['id'];
        $nombrePreg = $rowGetInfo['nombre'];
        $archivoPreg = $rowGetInfo['archivo'];
        $sqlGetResp = "SELECT id, nombre, archivo, correcta "
                . "FROM $tBResps WHERE banco_pregunta_id='$idPreg' ";
        $resGetResp = $con->query($sqlGetResp);
        while($rowGetResp = $resGetResp->fetch_assoc()){
            $idResp = $rowGetResp['id'];
            $nombreResp = $rowGetResp['nombre'];
            $archivoResp = $rowGetResp['archivo'];
            $respCorr = $rowGetResp['correcta'];
            $resps[] = array('id'=>$idResp, 'nombre'=>$nombreResp, 'respCorr'=>$respCorr, 'archivo'=>$archivoResp);
        }
        $pregs[] = array('id'=>$idPreg, 'nombre'=>$nombrePreg, 'archivo'=>$archivoPreg, 'resps'=>$resps);
    }
    
    echo json_encode(array("error"=>0, "dataPregs"=>$pregs, 'sql'=>$sqlGetInfo));
?>