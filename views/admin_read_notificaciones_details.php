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
        $idAv = $_GET['idNot'];
?>

    <div class="container">
         <div class="row">
            <div id="loading">
                <img src="../assets/obj/loading.gif" height="300" width="400">
            </div>
        </div>
        <br><br><br>
        <div class="table-responsive">
            <table class="table table-hover" id="dataAlum">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Alumno</th>
                        <th>Enterado</th>
                        <th>Fecha de enterado</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        $('#loading').hide();
        $(document).ready(function(){
            //Leemos las notificaciones leidas y NO leidas
            $.ajax({
                type: "POST",
                url: "../controllers/read_notificaciones_alumnos_detalles.php?idAv="+<?=$idAv;?>,
                success: function(msg){
                    console.log(msg);
                    var msg = jQuery.parseJSON(msg);
                    if(msg.error == 0){
                        $("#dataAlum tbody").html("");
                        $.each(msg.dataRes, function(i, item){
                            var newRow = '<tr>'
                                +'<td>'+msg.dataRes[i].id+'</td>'
                                +'<td>'+msg.dataRes[i].nombre+'</td>';
                                newRow += (msg.dataRes[i].enterado == 1) ? '<td>Si</td>' : '<td>No</td>';
                                newRow += (msg.dataRes[i].enterado == 1) ? '<td>'+msg.dataRes[i].fechaEnterado+'</td>' : '<td>   </td>';
                            newRow += '</tr>';
                            $(newRow).appendTo("#dataAlum");
                        });
                    }else{
                        $("#dataAlum tbody").html('<tr><td colspan="5">'+msg.msgErr+'</td></tr>');
                    }
                }
            });


        });
    </script>
    
<?php
    }//end if-else
    include ('footer.php');
?>
