<?php
    include ('header.php');
    include('../config/variables.php');
?>

<title><?=$tit;?></title>
<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
<meta name="description" content="Descripción de la página" />
<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />
</head>
    <body>
<?php
    include ('navbar.php');
    if (!isset($_SESSION['sessU'])){
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>No tienes permiso para entrar a esta sección. ━━[○･｀Д´･○]━━ </h2></div></div>';
    }else if($_SESSION['perfil'] != 3){
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>¿Estás tratando de acceder? No es tu perfil o(´^｀)o </h2></div></div>';
    }
    else {
        $idPerfil = $_SESSION['perfil'];
        $idUser = $_SESSION['userId'];
        unset ( $_SESSION['exaRand'] );
?>

    <div class="container">
        <div class="row text-center">
            <h1>Bienvenido Estudiante</h1>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <img src="../assets/obj/graduada.png" class="img-circle " >
            </div>
        </div>
    </div>
    
<?php
    }//end if-else
    include ('footer.php');
?>
