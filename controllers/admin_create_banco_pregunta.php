<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    ///Inputs ocultos
    $idUser = $_POST['idUser'];
    $idNivel = $_POST['idNivel'];
    
    //Información de la pregunta
    $preg1 = $_POST['inputPreg'];
    $filePreg1 = (isset($_FILES['files'])) ? $_FILES['files']['name'] : null;//imagen o audio opcional

    $ban = true; $banImg = true; $msgErr = '';
    $respPreg1 = array();
    $respFilePreg1 = array();   
    $respCorrsPreg1 = array();
    
    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png", "audio/mp3", "audio/mpeg");
    $limite_kb = 2048;
    //Obtenemos las respuestas de la pregunta principal

    if(isset($_POST['input1Radio'])){
        $respCorr1 = $_POST['input1Radio'][0];
        $countRespPreg1 = count($_POST['input1Resp']);
        for($i = 0; $i<$countRespPreg1; $i++){
            $respPreg1[] = $_POST['input1Resp'][$i];
            $respFilePreg1[] = (isset($_FILES['input1File'])) ? $_FILES['input1File']['name'][$i] : null;//imagen resp opcional
            $respCorrsPreg1[] = ( ($i+1) == $respCorr1) ? "1" : null; 
        }
    }else $banImg = false;
    
    /*print_r($respPreg1); echo 'Archivos'; print_r($respFilePreg1); echo 'Palabras'; 
    print_r($respWordsPreg1); echo 'Radio Buttons'; print_r($respCorrsPreg1);*/
    if($filePreg1 != null){//validamos si hay imagen en el archivo de pregunta
        if($_FILES['files']['error'] > 0){
            $msgErr .= 'Ha ocurrido un error al procesar archivo.<br>'.$_FILES['files']['error'];
            $ban = false;
        }else{
            if(in_array($_FILES['files']['type'], $permitidos)){
                if($_FILES['files']['size'] <= $limite_kb * 1024){
                    $ban = true;
                }else{
                    $msgErr .= 'Tamaño de archivo excede el límite de 1MB. Archivo pregunta';
                    $ban = false;
                }
            }else{
                $msgErr .= 'Formato de archivo no valido. Archivo pregunta';
                $ban = false;
            }
        }
    }
    
    if($banImg && $respFilePreg1[0] != null ){
        //Validamos las imágenes
        $countFilesResp1 = count($respFilePreg1);
        for($i = 0; $i < $countFilesResp1; $i++){
            if(in_array($_FILES['input1File']['type'][$i], $permitidos)){
                if($_FILES['input1File']['size'][$i] <= $limite_kb * 1024){
                    $ban = true;
                }else{
                    $msgErr .= 'El archivo excede el límite para las respuestas 1MB.'.($i+1);
                    $ban = false;
                    break;
                }
            }else{
                $msgErr .= 'Formato de archivo no valido para las respuestas.'.($i+1);
                $ban = false;
                break;
            }
        }   
    }else{
        $msgErr .= 'No se admiten campos vacios.';
    }
    
    if($ban){
        //Obtenemos la llave y 
        //Si es correcto empezamos a mover las imagenes
        //Si movemos bien las imagenes empezamos a insertar en la base de datos
        $sqlGetKey = "SELECT clave FROM $tUsers WHERE id='$idUser' ";
        $resGetKey = $con->query($sqlGetKey);
        $rowGetKey = $resGetKey->fetch_assoc();
        $key = $rowGetKey['clave'];
        $sqlGetNumPregs = "SELECT * FROM $tBPregs ";
        $resGetNumPregs = $con->query($sqlGetNumPregs);
        $countNumPregs = $resGetNumPregs->num_rows;
        $keyPregExam = $key.'_idPreg_'.($countNumPregs+1);
        //echo '--'.$keyPregExam;
        if($filePreg1 != null){//si existe la imagen obtenemos la extensión y la guardamos
            $extPreg1 = explode(".", $_FILES['files']['name']);
            $nameFile1 = $keyPregExam.".".$extPreg1[1];
            $ruta1 = "../".$filesExams."/".$nameFile1;
            $move1 = @move_uploaded_file($_FILES['files']['tmp_name'], $ruta1);
            $sqlInsertPreg = "INSERT INTO $tBPregs "
                    . "(nombre, archivo, banco_nivel_id, activo, creado) "
                    . "VALUES "
                    . "('$preg1', '$nameFile1', '$idNivel', '1', '$dateNow')";
        }else{ //si no hay imagen
            $sqlInsertPreg = "INSERT INTO $tBPregs "
                    . "(nombre, banco_nivel_id, activo, creado) "
                    . "VALUES "
                    . "('$preg1', '$idNivel', '1', '$dateNow')";
        }
        if($con->query($sqlInsertPreg) === TRUE){
            $idPreg = $con->insert_id;
            //Insertamos las respuestas según el tipo de respuesta
            for($m = 0; $m < count($respPreg1); $m++){
                if($respFilePreg1[$m] != null){//hay imagen
                    $extPreg2 = explode(".", $_FILES['input1File']['name'][$m]);
                    $nameFile2 = $keyPregExam."_resp_".$m.".".$extPreg2[1];
                    $ruta2 = "../".$filesExams."/".$nameFile2;
                    $move2 = @move_uploaded_file($_FILES['input1File']['tmp_name'][$m], $ruta2);
                    $sqlInsertResp = "INSERT INTO $tBResps "
                        . "(nombre, archivo, correcta, banco_pregunta_id, creado) "
                        . "VALUES "
                        . "('$respPreg1[$m]', '$nameFile2', '$respCorrsPreg1[$m]', '$idPreg', '$dateNow')";
                }else{//no hay imagen
                    $sqlInsertResp = "INSERT INTO $tBResps "
                        . "(nombre, correcta, banco_pregunta_id, creado) "
                        . "VALUES "
                        . "('$respPreg1[$m]', '$respCorrsPreg1[$m]', '$idPreg', '$dateNow')";
                }
                if($con->query($sqlInsertResp) === TRUE){
                    $ban=true;
                }else{
                    $ban = false;
                    $msgErr .= 'Error al insertar respuesta.<br>'.$con->error;
                    break;
                }
            }//end for
        }else{
            $ban = false;
            $msgErr .= 'Error al guardar pregunta.<br>'.$con->error;
        }
        
    }
    
    if($ban){
        $cad = 'Se añadio con éxito la pregunta con sus respuestas';
        echo json_encode(array("error"=>0, "msgErr"=>$cad));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
    
?>
