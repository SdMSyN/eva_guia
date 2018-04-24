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
        //Obtenemos Nombre del nivel
        $idEje = $_GET['idEje'];
        
        $sqlGetName = "SELECT $tBEjes.nombre as nameEje, $tBEjes.banco_materia_id as idMat, $tBMat.nombre as nameMat, "
                . "$tBMat.banco_nivel_escolar_id as idNivEsc, $tBNivEsc.nombre as nameNivEsc "
                . "FROM $tBEjes "
                . "INNER JOIN $tBMat ON $tBMat.id=$tBEjes.banco_materia_id "
                . "INNER JOIN $tBNivEsc ON $tBNivEsc.id=$tBMat.banco_nivel_escolar_id "
                . "WHERE $tBEjes.id='$idEje' ";
        $resGetName = $con->query($sqlGetName);
        $rowGetName = $resGetName->fetch_assoc();
        $nameEje = $rowGetName['nameEje'];
        $idMat = $rowGetName['idMat'];
        $nameMat = $rowGetName['nameMat'];
        $idNivel = $rowGetName['idNivEsc'];
        $nameNivEsc = $rowGetName['nameNivEsc'];
        
?>

    <div class="container">
        <div class="row">
            <div id="loading">
                <img src="../assets/obj/loading.gif" height="300" width="400">
            </div>
        </div>
        <div class="row text-center"><h1>Niveles</h1></div>
        <div class="row placeholder text-center">
            <div class="col-sm-12 placeholder">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalAdd">
                    Añadir nuevo nivel
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div>
        </div>
        <br>
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="admin_read_banco_niveles_escolares.php"><?=$nameNivEsc;?></a></li>
                <li><a href="admin_read_banco_materias.php?idNivel=<?=$idNivel;?>"><?=$nameMat;?></a></li>
                <li><a href="admin_read_banco_ejes.php?idMateria=<?=$idMat;?>"><?=$nameEje;?></a></li>
                <li class="active">Niveles</li>
            </ol>
        </div>
        <div class="table-responsive">
            <table class="table table-striped" id="data">
                <thead>
                    <tr>
                        <th><span title="id">Id</span></th>
                        <th><span title="nombre">Nombre</span></th>
                        <th><span title="created">Creado</span></th>
                        <th>Ver Preguntas</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        
        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labellebdy="myModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Añadir nuevo Nivel</h4>
                        <p class="msgModal"></p>
                    </div>
                    <form id="formAdd" name="formAdd">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="inputEje" value="<?=$idEje;?>" >
                                <label for="inputName">Nombre: </label>
                                <input type="text" class="form-control" id="inputName" name="inputName" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Añadir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#loading').hide();
        var ordenar = '';
        $(document).ready(function(){
           filtrar();
           function filtrar(){
               $.ajax({
                   type: "POST",
                   data: ordenar, 
                   url: "../controllers/get_niveles.php?idEje="+<?=$idEje;?>,
                   success: function(msg){
                       console.log(msg);
                       var msg = jQuery.parseJSON(msg);
                       if(msg.error == 0){
                           $("#data tbody").html("");
                           $.each(msg.dataRes, function(i, item){
                               var newRow = '<tr>'
                                    +'<td>'+msg.dataRes[i].id+'</td>'   
                                    +'<td>'+msg.dataRes[i].nombre+'</td>'   
                                    +'<td>'+msg.dataRes[i].creado+'</td>' 
                                    +'<td><a href="admin_read_banco_preguntas.php?idNiv='+msg.dataRes[i].id+'" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span></a></td>'
                                    +'</tr>';
                                $(newRow).appendTo("#data tbody");
                           });
                           
                       }else{
                           var newRow = '<tr><td></td><td>'+msg.msgErr+'</td></tr>';
                           $("#data tbody").html(newRow);
                       }
                   }
               });
           }
           
           //Ordenar ASC y DESC header tabla
            $("#data th span").click(function(){
                if($(this).hasClass("desc")){
                    $("#data th span").removeClass("desc").removeClass("asc");
                    $(this).addClass("asc");
                    ordenar = "&orderby="+$(this).attr("title")+" asc";
                }else{
                    $("#data th span").removeClass("desc").removeClass("asc");
                    $(this).addClass("desc");
                    ordenar = "&orderby="+$(this).attr("title")+" desc";
                }
                filtrar();
            });
           
           //añadir nuevo
           $('#formAdd').validate({
                rules: {
                    inputName: {required: true}
                },
                messages: {
                    inputName: "Nombre de la materia obligatorio"
                },
                tooltip_options: {
                    inputName: {trigger: "focus", placement: "bottom"}
                },
                submitHandler: function(form){
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/admin_create_banco_nivel.php",
                        data: $('form#formAdd').serialize(),
                        success: function(msg){
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                setTimeout(function () {
                                  location.href = 'admin_read_banco_niveles.php?idEje=<?=$idEje;?>';
                                }, 1500);
                            }else{
                                $('.msgModal').css({color: "#FF0000"});
                                $('.msgModal').html(msg.msgErr);
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.msgErr+'</p>');
                                setTimeout(function (){
                                    $('#loading').hide();
                                },1500);
                            }
                        }, error: function(){
                            alert("Error al crear nueva materia");
                        }
                    });
                }
            }); // end añadir nueva materia
           
        });
    </script>
    
<?php
    }//end if-else
    include ('footer.php');
?>
