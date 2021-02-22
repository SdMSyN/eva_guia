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

        
?>
        <section id="pricing" class="section">
            <div class="container">
                <div id="loading"><img src="../assets/obj/loading.gif"></div>
                <div class="row title text-center">
                    
                </div>
                <div class="row no-margin">
                    <div class="col-md-12 no-padding pricings ">
                        <br><br><br>
                        <div class="panel panel-default">
                            <div class="panel-heading">Historial de notificaciones</div>
                                <div class="panel-body">
                                    <div>
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#por_leer" aria-controls="por_leer" role="tab" data-toggle="tab">Pendientes</a></li>
                                        <li role="presentation"><a href="#leidos" aria-controls="leidos" role="tab" data-toggle="tab">Leídos</a></li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="por_leer">
                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="dataNotPorLeer">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Fecha</th>
                                                                <th>Título</th>
                                                                <th>Notificación</th>
                                                                <th>Enterado</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="leidos">
                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="dataNotLeidas">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Fecha</th>
                                                                <th>Título</th>
                                                                <th>Notificación</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    <script type="text/javascript">
        $('#loading').hide();
        $(document).ready(function(){
             //Leemos las notificaciones no leídas
             $.ajax({
                type: "POST",
                url: "../controllers/est_read_notificaciones_no_leidas.php?idEst="+<?=$idUser;?>,
                success: function(msg){
                    console.log(msg);
                    var msg = jQuery.parseJSON(msg);
                    if(msg.error == 0){
                        $("#dataNotPorLeer tbody").html("");
                        $.each(msg.dataRes, function(i, item){
                            let newRow = `<tr>
                                            <td>${ msg.dataRes[i].id }</td>
                                            <td>${ msg.dataRes[i].creado }</td>
                                            <td>${ msg.dataRes[i].titulo }</td>
                                            <td>${ msg.dataRes[i].descripcion }</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" id="marcarLeido" value="${ msg.dataRes[i].id }" style="background-color: #337ab7; ">
                                                    <span class="glyphicon glyphicon-saved"></span>
                                                </button>
                                            </td>
                                        </tr>`;
                            $(newRow).appendTo("#dataNotPorLeer");
                        });
                    }else{
                        $("#dataNotPorLeer tbody").html('<tr><td colspan="5">'+msg.msgErr+'</td></tr>');
                    }
                }
            });
            
            // Leemos las notificaciones leídas
            $.ajax({
                type: "POST",
                url: "../controllers/est_read_notificaciones_leidas.php?idEst="+<?=$idUser;?>,
                success: function(msg){
                    console.log(msg);
                    var msg = jQuery.parseJSON(msg);
                    if(msg.error == 0){
                        $("#dataNotLeidas tbody").html("");
                        $.each(msg.dataRes, function(i, item){
                            let newRow = `<tr>
                                            <td>${ msg.dataRes[i].id }</td>
                                            <td>${ msg.dataRes[i].creado }</td>
                                            <td>${ msg.dataRes[i].titulo }</td>
                                            <td>${ msg.dataRes[i].descripcion }</td>
                                        </tr>`;
                            $(newRow).appendTo("#dataNotLeidas");
                        });
                    }else{
                        $("#dataNotLeidas tbody").html('<tr><td colspan="4">'+msg.msgErr+'</td></tr>');
                    }
                }
            });

            // Aceptamos que leímos la notificación
            $("#dataNotPorLeer").on("click", "#marcarLeido", function(){
                let idAv = $(this).val();
                console.log( idAv )
                if(confirm("¿Seguro que ya haz leído la información?")){
                    $('#loading').show();
                    $.ajax({
                         method: "POST",
                         url: "../controllers/est_update_notificacion_vista.php?idAv="+idAv,
                         success: function(data){
                            console.log(data);
                            var msg = jQuery.parseJSON(data);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                $('#loading').append('<p>'+msg.dataRes+'</p>');
                                setTimeout(function () {
                                  location.href = 'est_read_notificaciones.php';
                                }, 1500);
                            }else{
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.msgErr+'</p>');
                                setTimeout(function(){$('#loading').hide();}, 1500);
                            }
                         }
                     })
                }else{
                    alert("Ten cuidado.");
                }
            });

        });

    </script>
    
<?php
    }//end session
    
    include ('footer2.php');
?>
