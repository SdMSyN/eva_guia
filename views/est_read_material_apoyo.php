<?php
    include ('header2.php');
    include('../config/variables.php');
    include('../config/conexion.php');
?>

<title><?=$tit;?></title>
<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
<meta name="description" content="Descripción de la página" />
<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />
</head>
    <body>
        <div class="preloader">
            <img src="../assets/img/loader.gif" alt="Preloader image">
	</div>
<?php
    include ('navbar3.php');
?>
        
        <?php
            if (!isset($_SESSION['sessU'])){
                echo '<div class="row><div class="col-sm-12 text-center"><h4>No tienes permiso para entrar a esta sección. ━━[○･｀Д´･○]━━ </h4></div></div>';
            }else if($_SESSION['perfil'] != 3){
                echo '<div class="row"><div class="col-sm-12 text-center"><h4>¿Estás tratando de acceder? No es tu perfil o(´^｀)o </h4></div></div>';
            }else {
                $idUser = $_SESSION['userId'];
				
				//buscamos material de apoyo en base al nivel
				/*$sqlGetMatApoyo = "SELECT $tBMat.nombre as mat, $tBEjes.nombre as eje, $tBMatApoyo.nombre as matApoyo "
					."FROM $tUsers "
					."INNER JOIN $tBNivEsc ON $tBNivEsc.id = $tUsers.banco_nivel_escolar_id "
					."INNER JOIN $tBMat ON $tBMat.banco_nivel_escolar_id = $tBNivEsc.id "
					."INNER JOIN $tBEjes ON $tBEjes.banco_materia_id = $tBMat.id "
					."INNER JOIN $tBMatApoyo ON $tBMatApoyo.banco_eje_id = $tBEjes.id "
					."WHERE $tUsers.id='$idUser' ";*/
					
				//Obtenemos el nivel
				$sqlGetNivel = "SELECT banco_nivel_escolar_id FROM $tUsers WHERE $tUsers.id='$idUser' ";
				$resGetNivel = $con->query($sqlGetNivel);
				$rowGetNivel = $resGetNivel->fetch_assoc();
				$idNivel = $rowGetNivel['banco_nivel_escolar_id'];
				//Obtenemos las material del nivel
				//Obtenemos los ejes del nivel
				//Obtenemos el material de apoyo del eje
				$cadMatApoyo = '<ul class="list-group">';
				$sqlGetMats = "SELECT id, nombre FROM $tBMat WHERE banco_nivel_escolar_id = '$idNivel' ";
				$resGetMats = $con->query($sqlGetMats);
				while($rowGetMats = $resGetMats->fetch_assoc()){
					$idMat = $rowGetMats['id'];
					$nameMat = $rowGetMats['nombre'];
					$cadMatApoyo .= '<li class="list-group-item"><b>';
					$cadMatApoyo .= $nameMat.'</b><ul>';
					$sqlGetEjes = "SELECT id, nombre FROM $tBEjes WHERE banco_materia_id='$idMat' ";
					$resGetEjes = $con->query($sqlGetEjes);
					while($rowGetEjes = $resGetEjes->fetch_assoc()){
						$idEje = $rowGetEjes['id'];
						$nameEje = $rowGetEjes['nombre'];
						$cadMatApoyo .= '<li>';
						$cadMatApoyo .= $nameEje.'<ul>';
						$sqlGetMatApoyo = "SELECT id, nombre, enlace FROM $tBMatApoyo WHERE banco_eje_id='$idEje' ";
						$resGetMatApoyo = $con->query($sqlGetMatApoyo);
						while($rowGetMatApoyo = $resGetMatApoyo->fetch_assoc()){
							$cadMatApoyo .= '<li><a href="'.$rowGetMatApoyo['enlace'].'" target="_blank">'.$rowGetMatApoyo['nombre'].'</a></li>';
						}
						$cadMatApoyo .= '</ul></li>';
					}
					$cadMatApoyo .= '</ul></li>';
				}
				$cadMatApoyo .= '</ul>';
				
				
        ?>
        <section id="pricing" class="section">
            <div class="container">
                <div class="row title text-center">
                    
                </div>
                <div class="row no-margin">
                    <div class="col-md-12 no-padding pricings ">
                        <br><br><br>
                        <div class="outer_div text-center"><h2 style="color: #FFF; ">Material de apoyo</h2></div>
                        <div id="dataExa"  class="list-group"><?= $cadMatApoyo; ?></div>
                    </div>
                </div>
            </div>
        </section>
        
    <script type="text/javascript">
        $(document).ready(function(){
			console.log("<?= $sqlGetMatApoyo; ?>");
        });

    </script>
    
<?php
    }//end session
    
    include ('footer2.php');
?>
