<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    include('../config/conexion.php');
    include('../config/variables.php');
    include('pagination.php');
    
    $idNivel = $_GET['idNivel'];
    $idUser = $_GET['idUser'];
    $pregs = array();
    $resps = array();
    $sql = array();
    
    //forma aleatoria 
    if(!isset($_SESSION['exaRand'])){
        $sqlGetIds = "SELECT id FROM $tBPregs WHERE banco_nivel_id='$idNivel' ";
        $resGetIds = $con->query($sqlGetIds);
        $arrIds = array();
        while($rowGetIds = $resGetIds->fetch_assoc()){
            $arrIds[] = $rowGetIds['id'];
        }
        //print_r($arrIds);
        $arrIdsRand = array_rand($arrIds, 10);
        $arrRand = array();
        foreach($arrIdsRand as $idRand){
            $arrRand[] = $arrIds[$idRand];
        }
        //print_r($arrRand);
        //print_r($arrIds);
        $_SESSION['exaRand'] = $arrRand;
    }
    //print_r($_SESSION['exaRand']);

    $page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 1;
    $adjacents = 1;
    $offset = ($page - 1) * $per_page;

    $numRows = 10;
    $totalPages = ceil($numRows/$per_page);
    $reload = '../views/est_read_exam2.php?idNivel='.$idNivel.'&idUser='.$idUser;
    //aleatorio
    $idPregSess = $_SESSION['exaRand'][$page-1];
    
    //$sqlGetInfo = "SELECT id, nombre, archivo, valor_preg, tipo_resp FROM $tBPregs WHERE exa_info_id='$idExam' AND id='$idPregSess' LIMIT 0, 1";
    $sqlGetInfo = "SELECT id, nombre, archivo "
            . "FROM $tBPregs WHERE id='$idPregSess' LIMIT 0, 1";
    
    $resGetInfo = $con->query($sqlGetInfo);
    while($rowGetInfo = $resGetInfo->fetch_assoc()){
        $idPreg = $rowGetInfo['id'];
        $nombrePreg = $rowGetInfo['nombre'];
        $archivoPreg = $rowGetInfo['archivo'];
        $sqlGetResp = "SELECT id, nombre, archivo FROM $tBResps WHERE banco_pregunta_id='$idPreg' ";
        $sql[] = $sqlGetResp;
        $resGetResp = $con->query($sqlGetResp);
        while($rowGetResp = $resGetResp->fetch_assoc()){
            $idResp = $rowGetResp['id'];
            $nombreResp = $rowGetResp['nombre'];
            $archivoResp = $rowGetResp['archivo'];
            //Buscamos si ya han respondido la respuesta
            $sqlGetRespTmp = "SELECT id FROM $tExaTmp "
                    . "WHERE estudiante_id='$idUser' AND banco_nivel_id='$idNivel' "
                    . "AND banco_pregunta_id='$idPreg' AND banco_respuesta_id='$idResp' ";
            $resGetRespTmp = $con->query($sqlGetRespTmp);
            $respSelect = null;
            $respSelect = ($resGetRespTmp->num_rows > 0) ? true : false;
            $resps[] = array('id'=>$idResp, 'nombre'=>$nombreResp, 'archivo'=>$archivoResp, 'seleccionada'=>$respSelect);
        }
        //aleatorio
        $pregs[] = array('id'=>$idPreg, 'nombre'=>$nombrePreg, 'archivo'=>$archivoPreg, 'resps'=>$resps, 'tmp'=>$idPregSess);
        //$pregs[] = array('id'=>$idPreg, 'nombre'=>$nombrePreg, 'archivo'=>$archivoPreg, 'tipoR'=>$tipoRespPreg, 'resps'=>$resps, 'tmp'=>$sqlGetRespTmp);
    }
    $paginador = '<div class="table-pagination text-center">'.paginate($reload, $page, $totalPages, $adjacents).'</div>';

    echo json_encode(array("error"=>0, "dataPregs"=>$pregs, 'pags'=>$paginador, 'sql'=>$_SESSION['exaRand']));
    
?>