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
        
        //obtenemos los niveles escolares
        $optNivEsc = '<option></option>';
        $sqlGetNivEsc = "SELECT * FROM $tBNivEsc ";
        $resGetNivEsc = $con->query($sqlGetNivEsc);
        while($rowGetNivEsc = $resGetNivEsc->fetch_assoc()){
            $optNivEsc .= '<option value="'.$rowGetNivEsc['id'].'">'.$rowGetNivEsc['nombre'].'</option>';
        }
?>

    <div class="container">
         <div class="row">
            <div id="loading">
                <img src="../assets/obj/loading.gif" height="300" width="400">
            </div>
        </div>
        <div class="row placeholder text-center">
            <div class="col-sm-12 placeholder"><br><br><br>
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalAdd">
                    Añadir Alumno
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-striped" id="data">
                <thead>
                    <tr>
                        <th><span title="id">Id</span></th>
                        <th><span title="nombre">Nombre</span></th>
                        <th><span title="user">Usuario</span></th>
                        <th><span title="pass">Contraseña</span></th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        
        <!-- Modal para actualizar datos  -->
        <div class="modal fade" id="modalUpd" tabindex="-1" role="dialog" aria-labellebdy="myModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Actualizar alumno</h4>
                        <p class="msgModal"></p>
                    </div>
                    <form id="formUpd" name="formUpd">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="inputIdUser" id="inputIdUser" >
                                <label for="inputName">Nombre: </label>
                                <input class="form-control" id="inputName" name="inputName" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Modal para añadir alumno -->
        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labellebdy="myModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Añadir nuevo alumno</h4>
                        <p class="msgModal"></p>
                    </div>
                    <form id="formAdd" name="formAdd">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputAP">Apellido Paterno: </label>
                                <input class="form-control" id="inputAP" name="inputAP">
                            </div>
                            <div class="form-group">
                                <label for="inputAM">Apellido Materno: </label>
                                <input class="form-control" id="inputAM" name="inputAM">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Nombre: </label>
                                <input class="form-control" id="inputName" name="inputName">
                            </div>
                            <div class="form-group">
                                <label for="inputNivEsc">Nivel escolar: </label>
                                <select class="form-control" id="inputNivEsc" name="inputNivEsc"><?=$optNivEsc;?></select>
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
           $('[data-toggle="tooltip"]').tooltip();
            
            filtrar();
           function filtrar(){
               $.ajax({
                   type: "POST",
                   data: ordenar, 
                   url: "../controllers/admin_read_estudiantes.php",
                   success: function(msg){
                       $("#data tbody").html(msg);
                       var msg = jQuery.parseJSON(msg);
                       //console.log(msg);
                       if(msg.error == 0){
                           $("#data tbody").html("");
                           $.each(msg.dataRes, function(i, item){
                                var newRow = '<tr>'
                                         +'<td>'+msg.dataRes[i].id+'</td>'
                                         +'<td>'+msg.dataRes[i].nombre+'</td>'
                                         +'<td>'+msg.dataRes[i].user+'</td>'
                                         +'<td>'+msg.dataRes[i].pass+'</td>'
                                         +'<td><button type="button" class="btn btn-warning" id="update" value="'+msg.dataRes[i].id+'" data-toggle="modal" data-target="#modalUpd"><span class="glyphicon glyphicon-refresh"></span></button></td>'
                                         +'<td><button type="button" class="btn btn-danger" id="delete" value="'+msg.dataRes[i].id+'"><span class="glyphicon glyphicon-remove"></span></button></td>'
                                    +'</tr>';
                                $(newRow).appendTo("#data tbody");
                            });
                       }else{
                           var newRow = '<tr><td colspan="4">'+msg.msgErr+'</td></tr>';
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
            
            $("#data").on("click", "#delete", function(){
                var idAlum = $(this).val();
                console.log(idAlum);
                if(confirm("¿Seguro que deseas eliminar a este estudiante?")){
                    $('#loading').show();
                    $.ajax({
                         method: "POST",
                         url: "../controllers/admin_delete_estudiante.php?idAlum="+idAlum,
                         success: function(data){
                            console.log(data);
                            var msg = jQuery.parseJSON(data);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                $('#loading').append('<p>'+msg.dataRes+'</p>');
                                setTimeout(function () {
                                  location.href = 'admin_read_estudiantes.php';
                                }, 1500);
                            }else{
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.msgErr+'</p>');
                                setTimeout(function () {
                                  $('#loading').hide();
                                }, 1500);
                            }
                         }
                     })
                }else{
                    alert("Ten cuidado.");
                }
            });
            
            $("#data").on("click", "#update", function(){
                var idAlum = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "../controllers/get_estudiante.php",
                    data: {idAlum: idAlum},
                    success: function(response){
                        var msg = jQuery.parseJSON(response);
                        console.log(response);
                        $("#modalUpd .modal-body #inputIdUser").val(msg.dataRes[0].id);
                        $("#modalUpd .modal-body #inputName").val(msg.dataRes[0].nombre);
                    }
                })
            });
            
            $('#formUpd').validate({
                rules:{
                    inputName: {required: true}
                },
                messages: {
                    inputName: "Nombre obligatorio"
                },
                tooltip_options: {
                    inputName: {trigger: "focus", placement: "bottom"}
                },
                submitHandler: function(form){
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/update_estudiante.php",
                        data: $('form#formUpd').serialize(),
                        success: function(msg){
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                $('.msgModal').css({color: "#77DD77"});
                                $('.msgModal').html(msg.msgErr);
                                setTimeout(function () {
                                  location.href = 'admin_read_estudiantes.php';
                                }, 1500);
                            }else{
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.msgErr+'</p>');
                                $('.msgModal').css({color: "#FF0000"});
                                $('.msgModal').html(msg.msgErr);
                                setTimeout(function () {
                                  $('#loading').hide();
                                }, 1500);
                            }
                        }, error: function(){
                            alert("Error al actualizar estudiante.");
                        }
                    });
                }
            })
            
            //añadir nuevo alumno
           $('#formAdd').validate({
                rules: {
                    inputName: {required: true},
                    inputAP: {required: true},
                    inputAM: {required: true},
                    inputNivEsc: {required: true}
                },
                messages: {
                    inputName: "Nombre obligatorio",
                    inputAP: "Nombre obligatorio",
                    inputAM: "Nombre obligatorio",
                    inputNivEsc: "Nivel Escolar obligatorio"
                },
                tooltip_options: {
                    inputName: {trigger: "focus", placement: "bottom"},
                    inputAP: {trigger: "focus", placement: "bottom"},
                    inputAM: {trigger: "focus", placement: "bottom"},
                    inputNivEsc: {trigger: "focus", placement: "bottom"}
                },
                submitHandler: function(form){
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/admin_create_estudiante.php",
                        data: $('form#formAdd').serialize(),
                        success: function(msg){
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                $('.msgModal').css({color: "#77DD77"});
                                $('.msgModal').html(msg.msgErr);
                                setTimeout(function () {
                                  location.href =  'admin_read_estudiantes.php';
                                }, 1500);
                            }else{
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.msgErr+'</p>');
                                $('.msgModal').css({color: "#FF0000"});
                                $('.msgModal').html(msg.msgErr);
                                setTimeout(function () {
                                  $('#loading').hide();
                                }, 1500);
                            }
                        }, error: function(){
                            alert("Error al añadir estudiante nuevo");
                        }
                    });
                }
            }); // end añadir nuevo alumno
            
            
        });
    </script>
    
<?php
    }//end if-else
    include ('footer.php');
?>
