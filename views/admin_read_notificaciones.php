<?php
    include ('header.php');
    include('../config/variables.php');
    include('../config/conexion.php');
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
        echo '<div class="row><div class="col-sm-12 text-center"><h2>No tienes permiso para entrar a esta sección. ━━[○･｀Д´･○]━━ </h2></div></div>';
    }else if($_SESSION['perfil'] != 1){
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>¿Estás tratando de acceder? No es tu perfil o(´^｀)o </h2></div></div>';
    }else {

?>

    <div class="container">
         <div class="row">
            <div id="loading">
                <img src="../assets/obj/loading.gif" height="300" width="400">
            </div>
        </div>
        
        <div class="row text-center"><h1>Notificaciones</h1></div>
        <div class="row placeholder text-center">
            <div class="col-sm-12 placeholder">
                <a href="admin_create_notificacion.php" class="btn btn-primary btn-lg" >
                    Añadir nueva notificación
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-striped" id="data">
                <thead>
                    <tr>
                        <th><span title="id">Id</span></th>
                        <th><span title="escuela">Escuela</span></th>
                        <th><span title="titulo">Notificación</span></th>
                        <th><span title="descripcion">Descripción</span></th>
                        <th><span title="tipo">Tipo</span></th>
                        <th><span title="creado">Fecha</span></th>
                        <th>Detalles</th>
                        <th># Alumnos</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

    </div>

    <script type="text/javascript">
        $('#loading').hide();
        var ordenar = '';
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            filtrar();
            function filtrar(){
                $.ajax({
                    type: "POST",
                    data: ordenar, 
                    url: "../controllers/admin_read_notificaciones.php",
                    success: function(msg){
                        console.log(msg);
                        var msg = jQuery.parseJSON(msg);
                        if(msg.error == 0){
                            $("#data tbody").html("");
                            $.each(msg.dataRes, function(i, item){
                                let newRow = `<tr>
                                    <td>${ msg.dataRes[i].id }</td>
                                    <td>${ msg.dataRes[i].escuela }</td>
                                    <td>${ msg.dataRes[i].titulo }</td>
                                    <td>${ msg.dataRes[i].descripcion }</td>
                                    <td>${ msg.dataRes[i].tipo }</td>
                                    <td>${ msg.dataRes[i].fecha }</td>
                                    <td><a href="admin_read_notificaciones_details.php?idNot=${ msg.dataRes[i].id }" class="btn btn-default" >
                                        <span class="glyphicon glyphicon-stats"></span> </a> </td>
                                    <td>${ msg.dataRes[i].numAlum } ( ${ msg.dataRes[i].numAlumEnt } ) </td>
                                </tr>`;
                                $(newRow).appendTo("#data tbody");
                            });
                           
                        } else {
                            var newRow = '<tr><td></td><td>'+msg.msgErr+'</td></tr>';
                            $("#data tbody").html(newRow);
                        }
                    }
                } );
            }

        });
    </script>
    
<?php
    }//end if-else
    include ('footer.php');
?>
