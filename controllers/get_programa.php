<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $programa = array();
    
    $msgErr = '';
    $ban = true;
    
    $idUser = $_POST['idUser'];
    // Obtenemos nivel escolar del usuario
    // Buscar las materias del nivel escolar
    // Buscar los ejes de cada materia
    // Buscar los niveles de cada eje
    // Buscar el score del nivel superior para habilitar o deshabilitar el nivel
    
    $sqlGetNivEsc = "SELECT banco_nivel_escolar_id FROM $tUsers WHERE id='$idUser' ";
    $resGetNivEsc = $con->query($sqlGetNivEsc);
    if($resGetNivEsc->num_rows > 0){
        $rowGetNivEsc = $resGetNivEsc->fetch_assoc();
        $idNivEsc = $rowGetNivEsc['banco_nivel_escolar_id'];
        $sqlGetMats = "SELECT id, nombre FROM $tBMat WHERE banco_nivel_escolar_id='$idNivEsc' ";
        $resGetMats = $con->query($sqlGetMats);
        if($resGetMats->num_rows > 0){
            $mats = array();
            while($rowGetMat = $resGetMats->fetch_assoc()){
                $idMat = $rowGetMat['id'];
                $nameMat = $rowGetMat['nombre'];
                $sqlGetEjes = "SELECT id, nombre FROM $tBEjes WHERE banco_materia_id='$idMat' ";
                $resGetEjes = $con->query($sqlGetEjes);
                $ejes = array();
                while($rowGetEje = $resGetEjes->fetch_assoc()){
                    $idEje = $rowGetEje['id'];
                    $nameEje = $rowGetEje['nombre'];
                    $sqlGetNivs = "SELECT id, nombre, superior_id FROM $tBNivs WHERE banco_eje_id='$idEje' ";
                    $resGetNivs = $con->query($sqlGetNivs);
                    $nivs = array();
                    while($rowGetNiv = $resGetNivs->fetch_assoc()){
                        $idNiv = $rowGetNiv['id'];
                        $nameNiv = $rowGetNiv['nombre'];
                        $supNiv = $rowGetNiv['superior_id'];
                        //Obtenemos Score del nivel actual
                        $sqlGetScore = "SELECT score FROM $tScoreE "
                                . "WHERE estudiante_id='$idUser' AND banco_nivel_id='$idNiv' ";
                        $resGetScore = $con->query($sqlGetScore);
                        $score = 0;
                        if($resGetScore->num_rows > 0){
                            $rowGetScore = $resGetScore->fetch_assoc();
                            $score = $rowGetScore['score'];
                        }
                        //Obtenemos Score superior para habilitar o deshabilitar
                        $sqlGetScoreEx = "SELECT score FROM $tScoreE "
                                . "WHERE estudiante_id='$idUser' AND banco_nivel_id='$supNiv' ";
                        $resGetScoreEx = $con->query($sqlGetScoreEx);
                        $scoreEx = 0;
                        if($supNiv != NULL){ //comprobamos que tenga superior
                            if($resGetScoreEx->num_rows > 0){
                                $rowGetScoreEx = $resGetScoreEx->fetch_assoc();
                                $scoreEx = $rowGetScoreEx['score'];
                                if($scoreEx >= 6){
                                    $disp = true;
                                }else{
                                    $disp = false;
                                }
                            }else{
                                $disp = false;
                            }
                        }else{//No tiene superior, es NULL
                            $disp = true;
                        }
                        //Obtenemos Score ejercicios
                        $sqlGetScoreEx = "SELECT score FROM $tScoreEj "
                                . "WHERE estudiante_id='$idUser' AND banco_nivel_id='$idNiv' ";
                        $resGetScoreEx = $con->query($sqlGetScoreEx);
                        $scoreEx = 0;
                        if($resGetScoreEx->num_rows > 0){
                            $rowGetScoreEx = $resGetScoreEx->fetch_assoc();
                            $scoreEx = $rowGetScoreEx['score'];
                        }
                        $nivs[] = array('idNiv'=>$idNiv, 'nameNiv'=>$nameNiv, 'score'=>$score, 'disp'=>$disp, 'scoreEx'=>$scoreEx);
                    }
                    $ejes[] = array('idEje'=>$idEje, 'nameEje'=>$nameEje, 'nivs'=>$nivs);
                }
                $mats[] = array('idMat'=>$idMat, 'nameMat'=>$nameMat, 'ejes'=>$ejes);
            }
        }else{
            $ban = false;
            $msgErr .= 'Error: No existen materias en éste nivel.';
        }
        $programa[] = array('mats'=>$mats);
    }else{
        $ban = false;
        $msgErr .= 'Error: No existe el nivel escolar.';
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$programa));
        //echo $msgErr;
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
        //echo $msgErr;
    }
    
?>