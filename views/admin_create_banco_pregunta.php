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
        $idNivel = $_GET['idNivel'];
        $idUser = $_SESSION['userId'];
        
        $sqlGetName = "SELECT $tBNivs.nombre as nameNivel, $tBEjes.id as idEje, "
                . "$tBEjes.nombre as nameEje, $tBEjes.banco_materia_id as idMat, $tBMat.nombre as nameMat, "
                . "$tBMat.banco_nivel_escolar_id as idNivEsc, $tBNivEsc.nombre as nameNivEsc "
                . "FROM $tBNivs "
                . "INNER JOIN $tBEjes ON $tBEjes.id=$tBNivs.banco_eje_id "
                . "INNER JOIN $tBMat ON $tBMat.id=$tBEjes.banco_materia_id "
                . "INNER JOIN $tBNivEsc ON $tBNivEsc.id=$tBMat.banco_nivel_escolar_id "
                . "WHERE $tBNivs.id='$idNivel' ";
        $resGetName = $con->query($sqlGetName);
        $rowGetName = $resGetName->fetch_assoc();
        $nameNivel = $rowGetName['nameNivel'];
        $idEje = $rowGetName['idEje'];
        $nameEje = $rowGetName['nameEje'];
        $idMat = $rowGetName['idMat'];
        $nameMat = $rowGetName['nameMat'];
        $idNivelEsc = $rowGetName['idNivEsc'];
        $nameNivEsc = $rowGetName['nameNivEsc'];
        
        
?>

    <div class="container">
         <div class="row">
            <div id="loading">
                <img src="../assets/obj/loading.gif" height="300" width="400">
            </div>
        </div>
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="admin_read_banco_niveles_escolares.php"><?=$nameNivEsc;?></a></li>
                <li><a href="admin_read_banco_materias.php?idNivel=<?=$idNivelEsc;?>"><?=$nameMat;?></a></li>
                <li><a href="admin_read_banco_ejes.php?idMateria=<?=$idMat;?>"><?=$nameEje;?></a></li>
                <li><a href="admin_read_banco_niveles.php?idEje=<?=$idEje;?>"><?=$nameNivel;?></a></li>
                <li><a href="admin_read_banco_preguntas.php?idNiv=<?=$idNivel;?>">Preguntas</a></li>
                <li class="active">Crear pregunta</li>
            </ol>
        </div>
        <div class="" id="contenedor" >
            <form id="formAdd" name="formAdd" class="form-horizontal">
                <div class="form-group">
                    <input type="hidden" name="idUser" value="<?=$idUser;?>">
                    <input type="hidden" name="idNivel" value="<?=$idNivel;?>">
                    <label for="input" class="col-sm-3 control-label">
                        Pregunta <p id="countPreg"><i>0/250</i></p>
                    </label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="inputPreg" name="inputPreg"></textarea>
                    </div>
                </div><!-- end form-group -->
                <div class="form-group">
                    <label for="input" class="col-sm-3 control-label">Archivo</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="files" name="files">
                    </div>
                </div><!-- end form-group -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="button" class="btn btn-success addResp" id="addResp">Añadir nueva respuesta</button>
                    </div>
                </div><!-- end form-group -->
                <div class="col-sm-offset-3 col-sm-9"  id="contenedorPregs">
                    
                </div>
                <div class="col-sm-12">
                     <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $('#loading').hide();
        /* Script para contar caracteres faltantes:
        http://mysticalpotato.wordpress.com/2012/10/27/contador-de-caracteres-para-textarea-al-estilo-twitter-con-jquery/ */
        init_contadorTa("inputPreg","countPreg", 250);
        function init_contadorTa(idtextarea, idcontador, max){
                $("#"+idtextarea).keyup(function(){
                        updateContadorTa(idtextarea, idcontador, max);
                });
                $("#"+idtextarea).change(function(){
                        updateContadorTa(idtextarea, idcontador, max);
                });
        }
        function updateContadorTa(idtextarea, idcontador, max){
                var contador= $("#"+idcontador);
                var ta= $("#"+idtextarea);
                contador.html("0/"+max);
                contador.html(ta.val().length+"/"+max);
                if(parseInt(ta.val().length) > max){
                        ta.val(ta.val().substring(0, max-1));
                        contador.html(max+"/"+max);
                }
        }
                
        $(document).ready(function(){ 
            $("#formAdd").validate({
                rules: {
                    inputPreg: {required: true},
                    files: {extension: "jpg|png|gif|jpeg|mp3"}
                },
                messages: {
                    inputPreg: "Campo obligatorio",
                    files: "Formato de archivo no valido"
                },
                tooltip_options:{
                    inputPreg: {trigger: "focus", placement: "bottom"},
                    files: {trigger: "focus", placement: "bottom"}
                },
                submitHandler: function(form){
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/admin_create_banco_pregunta.php",
                        data: new FormData($("form#formAdd")[0]),
                        //data: $('form#formAdd').serialize(),
                        contentType: false,
                        processData: false,
                        success: function(msg){
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                //console.log(msg);
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                setTimeout(function () {
                                  location.href = 'admin_create_banco_pregunta.php?idNivel='+<?=$idNivel;?>;
                                }, 1500);
                            }else{
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.msgErr+'</p>');
                                setTimeout(function () {
                                  $('#loading').hide();
                                }, 1500);
                            }
                        }, error: function(){
                            alert("Error");
                        }
                    });
                }
            })
             
        });
        </script>
        <script type="text/javascript">
            //añadir nuevos campos pzara materias y profesores
            var lineCols = new Array(null, 1);
            var maxInputs = 10;
            var contenedor = $("#contenedor");
            var contenedorPregs = $("#contenedorPregs");
            var addCampo = $("#addCampo");
            var x = 1;
            var FieldCount = x-1;
            var respType = 0;
            
            
            // Añadir campos dinamicos sobre campos dinamicos
            // http://jsfiddle.net/1ryvy98r/4/
            $(contenedor).on("click", ".addResp", function(e){
                var nline = 0; x++;
                var nCols = (++lineCols[nline]);
                var respu = '';
                
                    respu = '<div class="row"><div class="col-sm-6">';
                        respu += '<label for="inputResp">Respuesta</label>';
                        respu += '<input type="text" class="form-control" id="input1Resp" name="input1Resp[]">';
                    respu += '</div><!-- end col-sm-6 -->';
                    respu += '<div class="col-sm-4">';
                            respu += '<label for="inputResp">Imagen</label>';
                            respu += '<input type="file" class="form-control" id="input1File" name="input1File[]">';
                    respu += '</div><!-- end col-sm-6 -->';
                    respu += '<div class="col-sm-2">';
                        respu += '<label for="inputResp">¿Correcta?</label>';
                        respu += '<input type="radio" class="form-control" name="input1Radio[]" id="input1Radio" value="'+nCols+'" required>'+nCols;
                    respu += '</div></div>'; 
                
                $(contenedorPregs).append(respu);
                return false;
            })
            //Obtenemos valor del input radio
            $(contenedor).on("click", "#input1Radio", function(e){
                var rad = $(this).val();
                console.log(rad);
            });
    
           
    </script>
    
<?php
    }//end if-else
    include ('footer.php');
?>