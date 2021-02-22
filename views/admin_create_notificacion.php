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
        $optAvTipo = '<option></option>';
        $sqlGetAvTipo = "SELECT id_notificacionCtTipo, tipo FROM notificacionCtTipo ";
        $resGetAvTipo = $con->query($sqlGetAvTipo);
        while($rowGetAvTipo = $resGetAvTipo->fetch_assoc()){
            $optAvTipo .= '<option value="'.$rowGetAvTipo['id_notificacionCtTipo'].'">'.$rowGetAvTipo['tipo'].'</option>';
        }

        $optEscuelas = '<option></option>';
        $sqlGetEscuelas = "SELECT id, nombre FROM banco_escuelas ";
        $resGetEscuelas = $con->query($sqlGetEscuelas);
        while($rowGetEscuela = $resGetEscuelas->fetch_assoc()){
            $optEscuelas .= '<option value="'.$rowGetEscuela['id'].'">'.$rowGetEscuela['nombre'].'</option>';
        }
?>

    <div class="container">
         <div class="row">
            <div id="loading">
                <img src="../assets/obj/loading.gif" height="300" width="400">
            </div>
        </div>
        <br><br><br>
        <div class="row text-center"><h1>Crear Notificación</h1></div>
        <br>
        <form id="formAdd" class="form-horizontal">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputTituloAviso" >Título aviso</label>
                        <div class="col-sm-8">
                            <input class="form-control" id="inputTituloAviso" name="inputTituloAviso">
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="row">
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputDescripcionAviso">
                            Notificación<br><p id="countAv" style="color: #000;"><i>0/999</i></p>
                        </label>
                        <div class="col-sm-8">
                            <textarea typ="text" id="inputDescripcionAviso" name="inputDescripcionAviso" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputAvTipo" >Tipo de aviso</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="inputAvTipo" name="inputAvTipo"><?=$optAvTipo;?></select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputIdEscuela" >Escuela</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="inputIdEscuela" name="inputIdEscuela"><?=$optEscuelas;?></select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 text-center">
                    <button type="submit" class="btn btn-primary">Notificar</button>
                </div>
            </div><!-- end row -->
        </form>

    </div>

    <script type="text/javascript">
        $('#loading').hide();
        var ordenar = '';

        /* Script para contar caracteres faltantes:
        http://mysticalpotato.wordpress.com/2012/10/27/contador-de-caracteres-para-textarea-al-estilo-twitter-con-jquery/ */
        init_contadorTa("inputDescripcionAviso","countAv", 999);
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
            $('[data-toggle="tooltip"]').tooltip();
            
            //añadir notificación
            $('#formAdd').validate({
                rules: {
                    inputTituloAviso      : { required : true },
                    inputDescripcionAviso : { required : true },
                    inputAvTipo           : { required : true },
                    inputIdEscuela        : { required : true }
                },
                messages: {
                    inputTituloAviso        : "Título de la notificación obligatorio",
                    inputDescripcionAviso   : "Descripción de la notificación obligatorio",
                    inputAvTipo             : "Tipo de notificación obligatorio",
                    inputIdEscuela          : "Escuela a notificar obligatorio"
                },
                tooltip_options: {
                    inputTituloAviso      :  {trigger: "focus", placement: "bottom" },
                    inputDescripcionAviso :  {trigger: "focus", placement: "bottom" },
                    inputAvTipo           :  {trigger: "focus", placement: "bottom" },
                    inputIdEscuela        :  {trigger: "focus", placement: "bottom" }
                },
                submitHandler: function(form){
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/admin_create_notificacion.php",
                        data: $('form#formAdd').serialize(),
                        success: function(msg){
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                setTimeout(function () {
                                    location.href =  'admin_read_notificaciones.php';
                                }, 1500);
                            }else{
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.msgErr+'</p>');
                                setTimeout(function () {
                                    $('#loading').hide();
                                }, 1500);
                            }
                        }, error: function(){
                            alert("Error al añadir notificación");
                        }
                    });
                }
            }); // end añadir notificacion

        });
    </script>
    
<?php
    }//end if-else
    include ('footer.php');
?>
