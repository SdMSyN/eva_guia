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
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>No tienes permiso para entrar a esta sección. ━━[○･｀Д´･○]━━ </h2></div></div>';
    }else if($_SESSION['perfil'] != 3){
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>¿Estás tratando de acceder? No es tu perfil o(´^｀)o </h2></div></div>';
    }
    else {
        
        $idUser = $_GET['idUser'];
        $idNivel = $_GET['idNivel'];
        
?>

    <div class="container">
        <div id="loader"><img src="../assets/obj/loading.gif"></div>
        <div class="outer_div"></div>
        <div class="col-sm-12 text-center">
            <span id="liveclock"></span>
        </div>
        <!-- <div class="col-sm-12 text-center">
            <button type="button" class="btn btn-warning" id="evaluate">Terminar ejercicios 
                <span class="glyphicon glyphicon-screenshot"></span>
            </button>
        </div> -->
        <div id="dataExa"></div>
    </div>


    <script type="text/javascript">
        //$('#loading').hide();
        var ordenar = '';
        $(document).ready(function(){
            load(1);
            //Para evitar pegar 
            $('body').bind('cut copy paste', function (e) {
                e.preventDefault();
            });
            
            $(".outer_div").on("click", "#evaluate2", function(){
                if(confirm("¿Haz terminado ya los ejercicios? No hay vuelta atrás")){
                    $.ajax({
                         method: "POST",
                         url: "../controllers/est_create_score_ejercicio.php?idNivel=<?=$idNivel;?>&idUser=<?=$idUser;?>",
                         success: function(data){
                            //alert(data);
                            console.log(data);
                            var msg = jQuery.parseJSON(data);
                            if(msg.error == 0){
                                $('#loader').empty();
                                $('#loader').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                setTimeout(function () {
                                  location.href = 'est_read_result_ejercicio.php?idNivel=<?=$idNivel;?>';
                                }, 1500);
                            }else{
                                $('#loader').empty();
                                $('#loader').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.dataRes+'</p>');
                            }
                         }
                     })
                }else{
                    alert("Revisa minuciosamente");
                }
            })
            
            /*$("#evaluate").click(function(){
               if(confirm("¿Haz terminado ya los ejercicios? No hay vuelta atrás")){
                    $.ajax({
                         method: "POST",
                         url: "../controllers/est_create_score_ejercicio.php?idNivel=<?=$idNivel;?>&idUser=<?=$idUser;?>",
                         success: function(data){
                            //alert(data);
                            console.log(data);
                            var msg = jQuery.parseJSON(data);
                            if(msg.error == 0){
                                $('#loader').empty();
                                $('#loader').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                setTimeout(function () {
                                  location.href = 'est_programa.php';
                                }, 1500);
                            }else{
                                $('#loader').empty();
                                $('#loader').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.dataRes+'</p>');
                            }
                         }
                     })
                }else{
                    alert("Revisa minuciosamente");
                }
            });*/
        });
        
        function autoSave(){
            var idPreg = $("#idPreg").val();
            var idUser = <?=$idUser;?>;
            var idNivel = <?=$idNivel;?>;
            parametros2 = {
                "idUser":idUser,
                "idNivel":idNivel,
                "idPreg":idPreg
            };
            var idRadio = $("input[name=radio]:checked").val();
            parametros2.resp=idRadio;

            $.ajax({
                method: "POST",
                url: "../controllers/create_resp_exe_tmp.php",
                data: parametros2, //eres un pendejo, solo había que quitar las llaves ¡imbecil!
                //dataType: "json",
                success: function(data){
                    alert(data);
                    console.log(data);
                }
            })
        }
        
        //paginación
        // http://obedalvarado.pw/blog/paginacion-con-php-mysql-jquery-ajax-y-bootstrap/
        function load(page){
            var parametros = {"action": "ajax", "page": page};
            $("#loader").fadeIn('slow');
            $.ajax({
                url: "../controllers/est_read_exe.php?idNivel="+<?=$idNivel;?>+"&idUser="+<?=$idUser?>,
                data: parametros,
                beforeSend: function(objeto){
                    $("#loader").html('<img src="../assets/obj/loading.gif" height="300" width="400">');
                },
                success: function(data){
                    console.log(data);
                    var msg = jQuery.parseJSON(data);
                        if(msg.error == 0){
                            $("#loader").html("");
                            $("#data tbody").html("");
                            $("#dataExa").html("");
                            $.each(msg.dataPregs, function(i, item){
                                var newPreg = '<div class="row">'
                                    +'<div class="col-sm-12 text-center">'
                                        +'<input type="hidden" id="idPreg" name="idPreg" value="'+msg.dataPregs[i].id+'">'
                                        +'<p class="text-center">'
                                        +msg.dataPregs[i].nombre+'</p>'; 
                                        //+'<p class="text-center">**'+msg.dataPregs[i].tmp+'**</p>'
                                    newPreg += '</div></div>';
                                if(msg.dataPregs[i].archivo != null){ 
                                    var splitFile = msg.dataPregs[i].archivo;
                                    var extFile = splitFile.split(".");
                                    //console.log(splitFile+'--'+extFile[1]);
                                    if(extFile[1] == "mp3"){
                                        newPreg += '<div class="row">'
                                            +'<audio src="../<?=$filesExams;?>/'+msg.dataPregs[i].archivo+'" preload="auto" controls class="center-block"></audio>'
                                            +'</div>';
                                    }else{
                                        newPreg += '<div class="row">'
                                            +'<img src="../<?=$filesExams;?>/'+msg.dataPregs[i].archivo+'" class="img-responsive center-block" width="60%">'
                                            +'</div>';
                                    }
                                }
                                $(newPreg).appendTo("#dataExa");
                                $.each(msg.dataPregs[i].resps, function(j, item2){
                                    var newResp = '';
                                    newResp += '<div class="radio"><label>';
                                    if(msg.dataPregs[i].resps[j].archivo != null) 
                                        newResp += '<img src="../<?=$filesExams;?>/'+msg.dataPregs[i].resps[j].archivo+'" class="img-responsive center-block" >';
                                    newResp += '<input type="radio" name="radio" id="radio" value="'+msg.dataPregs[i].resps[j].id+'">';
                                    newResp += msg.dataPregs[i].resps[j].nombre;
                                    newResp += '</label></div>';
                                    
                                    //newResp += '</div><!-- end row -->';
                                    $(newResp).appendTo("#dataExa");
                                })
                           });
                           $(".outer_div").html(msg.pags);
                       }else{
                           var newRow = '<tr><td></td><td>'+msg.msgErr+'</td></tr>';
                           $("#data tbody").html(newRow);
                       }
                    //$(".outer_div").html(data).fadeIn('slow');
                    
                }
            })
        }
    </script>
    
<?php
    }//end if-else
    include ('footer.php');
?>