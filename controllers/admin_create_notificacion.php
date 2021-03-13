<?php
    include ('../config/conexion.php');
    include('../config/variables.php');
    
    $tituloAviso = $_POST['inputTituloAviso'];
    $descAviso   = $_POST['inputDescripcionAviso'];
    $avisoTipo   = $_POST['inputAvTipo'];
    $idEscuela   = $_POST['inputIdEscuela']; 
    
    $msgErr = '';
    $ban = true;
    $arrNot = array();

    // Insertamos la información de la notificación
    $sqlQry = "select 
                id_notificacionTrAviso,
                aviso,
                descripcion
                FROM notificacionTrAviso
                WHERE id_banco_escuelas = 1
                    AND 1 = 1";
    $sqlInsertAvisoInfo = "INSERT INTO notificacionTrAviso
            ( id_notificacionCtTipo, id_banco_escuelas, aviso, descripcion, created_at )
            VALUES ( $avisoTipo, $idEscuela, '$tituloAviso', '$descAviso', NOW() )";
    if($con->query($sqlInsertAvisoInfo) === TRUE){
        $idAviso = $con->insert_id;
        // Buscamos los alumnos activos pertenecientes a la escuela
        $sqlGetAlums = "SELECT 
                            usuarios.id AS Id
                        FROM usuarios
                        INNER JOIN usuarios_informacion ON usuarios.informacion_id = usuarios_informacion.id
                        WHERE usuarios_informacion.escuela_id = $idEscuela
                            AND usuarios.activo = 1
                            AND usuarios.perfil_id = 3
                        ";
        $resGetAlums = $con->query( $sqlGetAlums );
        if( $resGetAlums->num_rows > 0 ){
            while( $rowGetAlum = $resGetAlums->fetch_assoc() ){
                $idAlum = $rowGetAlum['Id'];
                $sqlInsertRlAA = "INSERT INTO notificacionRlAvisoAlumno
                    ( id_notificacionTrAviso, id_usuarios, created_at ) 
                    VALUES ( $idAviso, $idAlum, NOW() )
                ";
                if( $con->query( $sqlInsertRlAA ) === TRUE )
                    continue;
                else{
                    $ban = false;
                    $msgErr .= 'Error al insertar relación aviso-alumno<br>'.$idAviso.'-'.$idAlum.'<br>'.$con->error;
                    break;
                }
            }
        } else {
            $ban     = false;
            $msgErr .= 'Error: No existen alumnos en esta escuela.';
        }
        
    }else{
        $ban = false;
        $msgErr .= 'Error: No se pudo insertar la información del aviso.'.$con->error;
    }
        
    if($ban){
        echo json_encode(array("error"=>0));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
?>