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
        $idMateria = $_GET['idMateria'];
        
        $sqlGetNameMat = "SELECT $tBMat.nombre as nameMat, $tBMat.banco_nivel_escolar_id as idNivEsc, "
                . "$tBNivEsc.nombre as nameNivEsc "
                . "FROM $tBMat "
                . "INNER JOIN $tBNivEsc ON $tBNivEsc.id=$tBMat.banco_nivel_escolar_id "
                . "WHERE $tBMat.id='$idMateria' ";
        $resGetNameMat = $con->query($sqlGetNameMat);
        $rowGetNameMat = $resGetNameMat->fetch_assoc();
        $nameMat = $rowGetNameMat['nameMat'];
        $idNivel = $rowGetNameMat['idNivEsc'];
        $nameNivEsc = $rowGetNameMat['nameNivEsc'];
        
?>

    <div class="container">
        <div class="row">
            <div id="loading">
                <img src="../assets/obj/loading.gif" height="300" width="400">
            </div>
        </div>
        <div class="row text-center"><h1>Ejes</h1></div>
        <div class="row placeholder text-center">
            <div class="col-sm-12 placeholder">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalAdd">
                    Añadir nuevo eje
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div>
        </div>
        <br>
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="admin_read_banco_niveles_escolares.php"><?=$nameNivEsc;?></a></li>
                <li><a href="admin_read_banco_materias.php?idNivel=<?=$idNivel;?>"><?=$nameMat;?></a></li>
                <li class="active">Ejes</li>
            </ol>
        </div>
        <div class="table-responsive">
            <table class="table table-striped" id="data">
                <thead>
                    <tr>
                        <th><span title="id">Id</span></th>
                        <th><span title="nombre">Nombre</span></th>
                        <th><span title="created">Creado</span></th>
                        <th>Ver Niveles</th>
                        <th>Añadir material de apoyo</th>
                        <th>Ver Material</th>
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
                        <h4 class="modal-title" id="exampleModalLabel">Añadir nuevo Eje</h4>
                        <p class="msgModal"></p>
                    </div>
                    <form id="formAdd" name="formAdd">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="inputMat" value="<?=$idMateria;?>" >
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
		<!-- modal para añadir material de apoyo -->
		<div class="modal fade" id="modalAddMatApoyo" tabindex="-1" role="dialog" aria-labellebdy="myModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Añadir nuevo Material</h4>
                        <p class="msgModal"></p>
                    </div>
                    <form id="formAddMatApoyo" name="formAddMatApoyo">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="inputEje" id="inputEje" >
                                <label for="inputName">Nombre: </label>
                                <input type="text" class="form-control" id="inputName" name="inputName" >
                            </div>
							<div class="form-group">
                                <label for="inputLink">Enlace: </label>
                                <input type="text" class="form-control" id="inputLink" name="inputLink" >
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
		
		<div class="modal fade" id="modalViewMatApoyo" tabindex="-1" role="dialog" aria-labellebdy="myModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Material de Apoyo:</h4>
                        <p class="msgModal"></p>
                    </div>
                    <div class="modal-body">
                        <table id="dataMatApoyo" class="table table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>Material</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
                    </div>
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
                   url: "../controllers/get_ejes.php?idMat="+<?=$idMateria;?>,
                   success: function(msg){
                       var msg = jQuery.parseJSON(msg);
                       if(msg.error == 0){
                           $("#data tbody").html("");
                           $.each(msg.dataRes, function(i, item){
                               var newRow = '<tr>'
                                    +'<td>'+msg.dataRes[i].id+'</td>'   
                                    +'<td>'+msg.dataRes[i].nombre+'</td>'   
                                    +'<td>'+msg.dataRes[i].creado+'</td>' 
                                    +'<td><a href="admin_read_banco_niveles.php?idEje='+msg.dataRes[i].id+'" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span></a></td>'
									+'<td><button type="button" class="btn btn-default" id="addMatApoyo" value="'+msg.dataRes[i].id+'" data-toggle="modal" data-target="#modalAddMatApoyo"><span class="glyphicon glyphicon-plus"></span></button></td>'
									+'<td><button type="button" class="btn btn-default" id="viewMatApoyo" value="'+msg.dataRes[i].id+'" data-toggle="modal" data-target="#modalViewMatApoyo"><span class="glyphicon glyphicon-eye-open"></span></button></td>'
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
                        url: "../controllers/admin_create_banco_eje.php",
                        data: $('form#formAdd').serialize(),
                        success: function(msg){
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                setTimeout(function () {
                                  location.href = 'admin_read_banco_ejes.php?idMateria=<?=$idMateria;?>';
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
           
		    $("#data").on("click", "#addMatApoyo", function(){
                var idEje = $(this).val();
				$("#modalAddMatApoyo .modal-body #inputEje").val(idEje);
			});
			
			//añadir nuevo material de apoyo
           $('#formAddMatApoyo').validate({
                rules: {
                    inputName: {required: true},
                    inputLink: {required: true}
                },
                messages: {
                    inputName: "Nombre de la materia obligatorio",
                    inputLink: "Nombre de la materia obligatorio"
                },
                tooltip_options: {
                    inputName: {trigger: "focus", placement: "bottom"},
                    inputLink: {trigger: "focus", placement: "bottom"}
                },
                submitHandler: function(form){
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/admin_create_banco_material_apoyo.php",
                        data: $('form#formAddMatApoyo').serialize(),
                        success: function(msg){
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                setTimeout(function () {
                                  location.href = 'admin_read_banco_ejes.php?idMateria=<?=$idMateria;?>';
                                }, 1500);
                            }else{
                                $('#modalAddMatApoyo .msgModal').css({color: "#FF0000"});
                                $('#modalAddMatApoyo .msgModal').html(msg.msgErr);
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
           
		   $("#data").on("click", "#viewMatApoyo", function(){
                var idEje = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "../controllers/admin_read_banco_material_apoyo.php?idEje="+idEje,
                    success: function(msg){
						console.log(msg);
                        var msg = jQuery.parseJSON(msg);
                        if(msg.error == 0){
                            $("#modalViewMatApoyo .modal-body #dataMatApoyo tbody").html("");
                            $.each(msg.dataRes, function(i, item){
								var newRow = '<tr>'
									+'<td>'+msg.dataRes[i].id+'</td>'
									+'<td><a href="'+msg.dataRes[i].enlace+'" target="_blank">'+msg.dataRes[i].nombre+'</a></td>'
									+'</tr>';
									$(newRow).appendTo("#modalViewMatApoyo .modal-body #dataMatApoyo tbody");
							});
						}
					}
				});
		   });
		   
        });
    </script>
    
<?php
    }//end if-else
    include ('footer.php');
?>
