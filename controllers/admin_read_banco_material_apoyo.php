<?php
    session_start();
    include('../config/conexion.php');
    include('../config/variables.php');
    
    //include('pagination.php');
    $idEje = $_GET['idEje'];
    $pregs = array();
    $material = array();

    $sqlGetInfo = "SELECT id, nombre, enlace  "
            . "FROM $tBMatApoyo WHERE banco_eje_id='$idEje' ";
    $resGetInfo = $con->query($sqlGetInfo);
	while($rowGetInfo = $resGetInfo->fetch_assoc()){
		$id = $rowGetInfo['id'];
		$nombre = $rowGetInfo['nombre'];
		$enlace = $rowGetInfo['enlace'];
		$material[] = array('id'=>$id, 'nombre'=>$nombre, 'enlace'=>$enlace);
	}
    
    echo json_encode(array("error"=>0, "dataRes"=>$material, 'sql'=>$sqlGetInfo));
?>