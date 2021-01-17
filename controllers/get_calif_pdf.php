<?php

session_start();
include('../config/conexion.php');
include('../config/variables.php');
//fpdf
require('../classes/fpdf/fpdf.php');

if (isset($_SESSION['userId'])) {
    $idUser = $_SESSION['userId'];
} else {
    $idUser = 0;
}

class PDF extends FPDF {

    // Cabecera de página
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, utf8_decode('Calificaciones GUIA'), 0, 1, 'C');
        // Salto de línea
        //$this->Ln(9);
    }

    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(0, 10, utf8_decode('Calificaciones de la GUIA escolar, desarrollado por Software de México: Soluciones y Negocios S.A.S. de C.V. | http://solucionesynegocios.com.mx'), 'T', 0, 'C');
    }

}

//Fin class PDF
//Obtenemos los datos del usuario
$sqlGetUser = "SELECT $tUsers.nombre as name, $tUsers.user as user, $tBEsc.nombre as nameEsc "
        . "FROM $tUsers "
        . "INNER JOIN $tInfo ON $tInfo.id = $tUsers.informacion_id "
        . "INNER JOIN $tBEsc ON $tBEsc.id = $tInfo.escuela_id "
        . "WHERE $tUsers.id = '$idUser' ";
$resGetUser = $con->query($sqlGetUser);
$rowGetUser = $resGetUser->fetch_assoc();

$pdf = new PDF();
$pdf->AddPage('P', 'Letter');
$pdf->SetFont('Arial', '', 10);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(17, 10, utf8_decode('Nombre: '), 1, 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(60, 10, utf8_decode($rowGetUser['name']), 1, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(17, 10, utf8_decode('Usuario: '), 1, 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 10, utf8_decode($rowGetUser['user']), 1, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(17, 10, utf8_decode('Escuela: '), 1, 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 10, utf8_decode($rowGetUser['nameEsc']), 1, 1, 'L');
$pdf->Ln(9);

$programa = array();

$msgErr = '';
$cad = '';
$ban = true;
// Obtenemos nivel escolar del usuario
// Buscar las materias del nivel escolar
// Buscar los ejes de cada materia
// Buscar los niveles de cada eje
// Buscar el score del nivel superior para habilitar o deshabilitar el nivel

$sqlGetNivEsc = "SELECT banco_nivel_escolar_id FROM $tUsers WHERE id='$idUser' ";
$resGetNivEsc = $con->query($sqlGetNivEsc);
if ($resGetNivEsc->num_rows > 0) {
    $rowGetNivEsc = $resGetNivEsc->fetch_assoc();
    $idNivEsc = $rowGetNivEsc['banco_nivel_escolar_id'];
    $sqlGetMats = "SELECT id, nombre FROM $tBMat WHERE banco_nivel_escolar_id='$idNivEsc' ";
    $resGetMats = $con->query($sqlGetMats);
    if ($resGetMats->num_rows > 0) {
        $mats = array();
        while ($rowGetMat = $resGetMats->fetch_assoc()) {
            $idMat = $rowGetMat['id'];
            $nameMat = $rowGetMat['nombre'];
            $pdf->Cell(60, 10, utf8_decode($nameMat), 1, 0, 'L');
            $pdf->Cell(10, 10, "I", 1, 0, 'C');
            $pdf->Cell(10, 10, "II", 1, 0, 'C');
            $pdf->Cell(10, 10, "III", 1, 0, 'C');
            $pdf->Cell(10, 10, "IV", 1, 1, 'C');
            $sqlGetEjes = "SELECT id, nombre FROM $tBEjes WHERE banco_materia_id='$idMat' ";
            $resGetEjes = $con->query($sqlGetEjes);
            $ejes = array();
            while ($rowGetEje = $resGetEjes->fetch_assoc()) {
                $idEje = $rowGetEje['id'];
                $nameEje = $rowGetEje['nombre'];
                $pdf->Cell(10, 10, " ", 1, 0, 'L');
                $pdf->Cell(50, 10, utf8_decode($nameEje), 1, 0, 'L');
                $sqlGetNivs = "SELECT id, nombre, superior_id FROM $tBNivs WHERE banco_eje_id='$idEje' ";
                $resGetNivs = $con->query($sqlGetNivs);
                $nivs = array();
                while ($rowGetNiv = $resGetNivs->fetch_assoc()) {
                    $idNiv = $rowGetNiv['id'];
                    $nameNiv = $rowGetNiv['nombre'];
                    $supNiv = $rowGetNiv['superior_id'];
                    //Obtenemos Score del nivel actual
                    $sqlGetScore = "SELECT score FROM $tScoreE "
                            . "WHERE estudiante_id='$idUser' AND banco_nivel_id='$idNiv' ";
                    $resGetScore = $con->query($sqlGetScore);
                    $score = 0;
                    if ($resGetScore->num_rows > 0) {
                        $rowGetScore = $resGetScore->fetch_assoc();
                        $score = $rowGetScore['score'];
                        $pdf->Cell(10, 10, utf8_decode($score), 1, 0, 'R');
                    }
                    //Obtenemos Score superior para habilitar o deshabilitar
                    $sqlGetScoreEx = "SELECT score FROM $tScoreE "
                            . "WHERE estudiante_id='$idUser' AND banco_nivel_id='$supNiv' ";
                    $resGetScoreEx = $con->query($sqlGetScoreEx);
                    $scoreEx = 0;
                    if ($supNiv != NULL) { //comprobamos que tenga superior
                        if ($resGetScoreEx->num_rows > 0) {
                            $rowGetScoreEx = $resGetScoreEx->fetch_assoc();
                            $scoreEx = $rowGetScoreEx['score'];
                            if ($scoreEx >= 6) {
                                $disp = true;
                            } else {
                                $disp = false;
                            }
                        } else {
                            $disp = false;
                        }
                    } else {//No tiene superior, es NULL
                        $disp = true;
                    }
                    //Obtenemos Score ejercicios
                    $sqlGetScoreEx = "SELECT score FROM $tScoreEj "
                            . "WHERE estudiante_id='$idUser' AND banco_nivel_id='$idNiv' ";
                    $resGetScoreEx = $con->query($sqlGetScoreEx);
                    $scoreEx = 0;
                    if ($resGetScoreEx->num_rows > 0) {
                        $rowGetScoreEx = $resGetScoreEx->fetch_assoc();
                        $scoreEx = $rowGetScoreEx['score'];
                    }
                    $nivs[] = array('idNiv' => $idNiv, 'nameNiv' => $nameNiv, 'score' => $score, 'disp' => $disp, 'scoreEx' => $scoreEx);
                }
                $ejes[] = array('idEje' => $idEje, 'nameEje' => $nameEje, 'nivs' => $nivs);
                $pdf->Ln();
            }
            $mats[] = array('idMat' => $idMat, 'nameMat' => $nameMat, 'ejes' => $ejes);
        }
    } else {
        $ban = false;
        $msgErr .= 'Error: No existen materias en éste nivel.';
    }
    $programa[] = array('mats' => $mats);
} else {
    $ban = false;
    $msgErr .= 'Error: No existe el nivel escolar.';
}

$pdf->Output();
?>