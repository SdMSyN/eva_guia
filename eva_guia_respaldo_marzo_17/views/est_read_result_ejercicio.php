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
    <body onload="notBack()">
<?php
    include ('navbar3.php');
    if (!isset($_SESSION['sessU'])){
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>No tienes permiso para entrar a esta sección. ━━[○･｀Д´･○]━━ </h2></div></div>';
    }else if($_SESSION['perfil'] != 3){
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>¿Estás tratando de acceder? No es tu perfil o(´^｀)o </h2></div></div>';
    }
    else {
        $idUser = $_SESSION['userId'];
        $idNivel = $_GET['idNivel'];
        unset ( $_SESSION['exeRand'] );
        unset ( $_SESSION['exaRand'] );
        
?>

    <section id="pricing" class="section">
        <div class="container">
            <div class="row no-margin">
                
                <div class="col-md-12 no-padding pricings text-center">
                    <div class="row">
                        <a href="est_read_exe2.php?idNivel=<?=$idNivel;?>&idUser=<?=$idUser;?>" class="btn btn-success">
                            Repetir Ejercicios <span class="glyphicon glyphicon-repeat"></span></a>
                    </div>
                    <div class="col-sm-6" id="resultLeft">
                        <table class="table text-right active"> 
                            <tr class="active"><td>Número de preguntas</td></tr>
                            <tr class="active"><td>Respuestas correctas</td></tr>
                            <tr class="active"><td>Respuestas incorrectas</td></tr>
                            <tr class="active"><td>Porcentaje</td></tr>
                            <tr class="active"><td># de intentos</td></tr>
                        </table>
                    </div>
                    <div class="col-sm-6" id="resultRight">
                        <table class="table text-left active" id="resultRightTable"></table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        function notBack(){
            window.location.hash="no-back-button";
            window.location.hash="Again-No-back-button" //chrome
            window.onhashchange=function(){window.location.hash="no-back-button";}
        }
    </script>
    
    <script language="JavaScript" type="text/javascript">
         $('#loading').hide();
        var ordenar = '';
        $(document).ready(function(){
            $.ajax({
                method: "POST",
                url: "../controllers/est_read_result_ejercicio.php?idUser=<?=$idUser;?>&idNivel=<?=$idNivel;?>",
                success: function(data){
                   //alert(data);
                   console.log(data);
                   var msg = jQuery.parseJSON(data);
                   if(msg.error == 0){
                        var newRow = '';
                            newRow += '<tr><td class="active">'+msg.dataRes[0].numPregs+'</td></tr>';
                            newRow += '<tr><td class="active">'+msg.dataRes[0].score+' <span class="glyphicon glyphicon-ok"></span></td></tr>';
                            newRow += '<tr><td class="active">'+msg.dataRes[0].inco+' <span class="glyphicon glyphicon-remove"></td></tr>';
                            newRow += '<tr><td class="active">'+msg.dataRes[0].porc+' </span></td></tr>';
                            newRow += '<tr><td class="active">'+msg.dataRes[0].numInt+'</td></tr>';
                        $("#resultRight #resultRightTable").html(newRow);
                   }else{
                       var newRow = '<tr class="active"><td></td><td>'+msg.msgErr+'</td></tr>';
                        $("#resultRight #resultRightTable").html(newRow);
                   }
                }
            })
        });
    </script>
    
<?php
    }//end if-else
    include ('footer2.php');
?>