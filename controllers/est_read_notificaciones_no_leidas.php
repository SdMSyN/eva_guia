<?php
    include ('../config/conexion.php');
    include('../config/variables.php');
    
    $idEst = $_GET['idEst'];

    $msgErr = '';
    $ban = true;
    $arrNot = array();
    
    $sqlGetAvInfo = "SELECT
                        notificacionRlAvisoAlumno.id_notificacionRlAvisoAlumno AS Id,
                        notificacionTrAviso.aviso,
                        notificacionTrAviso.descripcion,
                        notificacionTrAviso.created_at
                    FROM notificacionRlAvisoAlumno
                        INNER JOIN notificacionTrAviso ON notificacionRlAvisoAlumno.id_notificacionTrAviso = notificacionTrAviso.id_notificacionTrAviso
                    WHERE notificacionRlAvisoAlumno.id_usuarios = $idEst
                        AND notificacionRlAvisoAlumno.enterado IS NULL
                    ORDER BY created_at ";

    $resGetAvInfo = $con->query($sqlGetAvInfo);
    if($resGetAvInfo->num_rows > 0){
        while($rowGetAvInfo = $resGetAvInfo->fetch_assoc()){
            $notIdAsig = $rowGetAvInfo['Id'];
            $notName = $rowGetAvInfo['aviso'];
            $notDesc = $rowGetAvInfo['descripcion'];
            $notDate = $rowGetAvInfo['created_at'];
            $arrNot[] = array( 'id' => $notIdAsig, 'titulo' => $notName, 'descripcion' => $notDesc, 'creado' => $notDate );
        }
    }else{
        $ban = false;
        $msgErr .= 'No existen notificaciones.';
    }
    

    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$arrNot));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
?>