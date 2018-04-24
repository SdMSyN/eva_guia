<?php
$elementos = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 50, 20, 30);
print_r($elementos);
$claves = array_rand($elementos, 4);
foreach($claves as $clave)
{
	echo $elementos[$clave].'<br>';
}

include('../config/conexion.php');
include('../config/variables.php');

$idNivel = 1;
$pregs = array();
$resps = array();
$sql = array();

//forma aleatoria 
    $sqlGetIds = "SELECT id FROM $tBPregs WHERE banco_nivel_id='$idNivel' ";
    $resGetIds = $con->query($sqlGetIds);
    $arrIds = array();
    while($rowGetIds = $resGetIds->fetch_assoc()){
        $arrIds[] = $rowGetIds['id'];
    }
    print_r($arrIds);
    $arrIdsRand = array_rand($arrIds, 3);
    $arrRand = array();
    foreach($arrIdsRand as $idRand){
        $arrRand[] = $arrIds[$idRand];
    }
    print_r($arrRand);
    //$_SESSION['exaRand'] = $arrIds;
    
//print_r($_SESSION['exaRand']);
?>