<?php
    include ('../config/conexion.php');
    include('../config/variables.php');

    $msgErr = '';
    $ban = true;
    $arrNot = array();
    
    $sqlGetAvInfo = "SELECT
                        notificacionTrAviso.id_notificacionTrAviso AS Id,
                        notificacionTrAviso.aviso,
                        notificacionTrAviso.descripcion,
                        notificacionCtTipo.tipo,
                        banco_escuelas.nombre,
                        notificacionTrAviso.created_at
                    FROM notificacionTrAviso
                    INNER JOIN notificacionCtTipo ON notificacionTrAviso.id_notificacionCtTipo = notificacionCtTipo.id_notificacionCtTipo
                    INNER JOIN banco_escuelas     ON notificacionTrAviso.id_banco_escuelas = banco_escuelas.id ";

    $resGetAvInfo = $con->query( $sqlGetAvInfo );
    if( $resGetAvInfo->num_rows > 0 ){
        while( $rowGetAvInfo = $resGetAvInfo->fetch_assoc() ){
            $notId     = $rowGetAvInfo['Id'];
            $notTitulo = $rowGetAvInfo['aviso'];
            $notDesc   = $rowGetAvInfo['descripcion'];
            $notType   = $rowGetAvInfo['tipo'];
            $escuela   = $rowGetAvInfo['nombre'];  
            $notDate   = $rowGetAvInfo['created_at'];
            //Obtenemos números de informados Alumnos
            $sqlGetNumAlums = " SELECT COUNT(*) as numAlumsAv,
                                ( SELECT 
                                    COUNT(*) 
                                  FROM notificacionRlAvisoAlumno 
                                  WHERE id_notificacionTrAviso = $notId 
                                    AND enterado IS NOT NULL
                                ) as numEnt
                                FROM notificacionRlAvisoAlumno
                                WHERE id_notificacionTrAviso = $notId ";
            $resGetNumAlums = $con->query($sqlGetNumAlums);
            $rowGetNumAlums = $resGetNumAlums->fetch_assoc();
            $numAvAlum      = $rowGetNumAlums['numAlumsAv'];
            $numAvAlumEnt   = $rowGetNumAlums['numEnt'];
            
            $arrNot[] = array( 'id' => $notId, 'titulo' => $notTitulo, 'descripcion' => $notDesc, 
                'tipo' => $notType, 'escuela' => $escuela, 'fecha' => $notDate, 
                'numAlum' => $numAvAlum, 'numAlumEnt' => $numAvAlumEnt );
        }
    }else{
        $ban = false;
        $msgErr .= 'No existen notificaciones.';
    }
    

    if($ban){
        echo json_encode( array( "error" => 0, "dataRes" => $arrNot ) );
    }else{
        echo json_encode( array( "error" => 1, "msgErr" => $msgErr, "sql" => $sqlGetAvInfo ) );
    }
?>