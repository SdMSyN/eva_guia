<?php
    include ('header2.php');
    include('../config/variables.php');
?>

<title><?=$tit;?></title>
<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
<meta name="description" content="Descripción de la página" />
<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />
</head>
    <body onload="notBack()">
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
                $idUser = $_GET['idUser'];
                $idNivel = $_GET['idNivel'];
        ?>
        <section id="pricing" class="section">
            <div class="container">
                <div class="row no-margin">
                    <div class="col-md-12 no-padding pricings text-center">
                        <br><br><br>
                        <div class="outer_div"></div>
                        <div class="col-sm-12 text-center"><span id="liveclock"></span></div>
                        <div class="col-sm-12 text-center">
                            <button type="button" class="btn btn-warning" id="evaluate">Terminar examen 
                                <span class="glyphicon glyphicon-screenshot"></span>
                            </button>
                        </div>
                        <div id="dataExa"></div>
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
        var d1 = new Date (),
            d2 = new Date ( d1 );
            d2.setMinutes ( d1.getMinutes() + 10 );
            var minInicioExa=d2.getMinutes();
            var horaInicioExa=d2.getHours();
            var segInicioExa=d2.getSeconds();
            
        function show5(){
            if (!document.layers&&!document.all&&!document.getElementById)
            return

             var Digital=new Date()
             var hours=Digital.getHours()
             var minutes=Digital.getMinutes()
             var seconds=Digital.getSeconds()

             var hour = horaInicioExa - hours;
             var min = minInicioExa - minutes;
             var sec = segInicioExa - seconds;
             if (min < 0) {
                hour--;
                min = 60 + min;
              }
              if(sec < 0){
                  min--;
                  sec = 60 + sec;
              }
              var minS=min; var secS=sec;
             if (min<=9)
             minS="0"+min
             if (sec<=9)
             secS="0"+sec
             if(hour <= 0 && min <= 0 && sec <= 0){
                /*
                $.ajax({
                   method: "POST",
                   url: "../controllers/est_create_exa_result_preguntas.php?idUser=<?=$idUser;?>&idExam=<?=$idExam;?>&idExamAsig=<?=$idExamAsig;?>&idExamAsigAlum=<?=$idExamAsigAlum?>&idExaTime=<?=$idExaTime;?>",
                   success: function(data){
                      console.log(data);
                      var msg = jQuery.parseJSON(data);
                      if(msg.error == 0){
                          $('#loading').empty();
                          $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                          setTimeout(function () {
                            location.href = 'est_read_exa_result.php?idExam=<?=$idExam;?>&idUser=<?=$idUser;?>&idExamAsig=<?=$idExamAsig;?>&idExamAsigAlum=<?=$idExamAsigAlum;?>';
                          }, 1500);
                      }else{
                          $('#loading').empty();
                          $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.dataRes+'</p>');
                      }
                   }
               })*/
            }else{
                //change font size here to your desire
                myclock="<font size='5' face='Arial' color'#000'><b><font size='1'>Te quedan:</font></br>"+hour+":"+minS+":"
                 +secS+" </b></font>";
                 //myclock += "Tiempo de finalización: "+timeBegin;
                if (document.layers){
                    document.layers.liveclock.document.write(myclock)
                    document.layers.liveclock.document.close()
                }
                else if (document.all)
                    liveclock.innerHTML=myclock
                else if (document.getElementById)
                    document.getElementById("liveclock").innerHTML=myclock
                setTimeout("show5()",1000)
                }//end else
        }
        window.onload=show5
        //-->
    </script>
        
    <script type="text/javascript">
        //$('#loading').hide();
        var ordenar = '';
        $(document).ready(function(){
            load(1);
            //Para evitar pegar 
            $('body').bind('cut copy paste', function (e) {
                e.preventDefault();
            });
            
            $("#evaluate").click(function(){
                autoSave();
               if(confirm("¿Haz terminado ya el examen? No hay vuelta atrás")){
                    $.ajax({
                         method: "POST",
                         url: "../controllers/est_create_score_examen.php?idNivel=<?=$idNivel;?>&idUser=<?=$idUser;?>",
                         success: function(data){
                            //alert(data);
                            console.log(data);
                            var msg = jQuery.parseJSON(data);
                            if(msg.error == 0){
                                $('#loader').empty();
                                $('#loader').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                setTimeout(function () {
                                  location.href = 'est_read_result_examen.php?idNivel=<?=$idNivel;?>';
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
            });
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
                url: "../controllers/create_resp_exa_tmp.php",
                data: parametros2, //eres un pendejo, solo había que quitar las llaves ¡imbecil!
                //dataType: "json",
                success: function(data){
                    //alert(data);
                }
            })
        }
        
        //paginación
        // http://obedalvarado.pw/blog/paginacion-con-php-mysql-jquery-ajax-y-bootstrap/
        function load(page){
            var parametros = {"action": "ajax", "page": page};
            $("#loader").fadeIn('slow');
            $.ajax({
                url: "../controllers/est_read_exam2.php?idNivel="+<?=$idNivel;?>+"&idUser="+<?=$idUser?>,
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
                                            +'<img src="../<?=$filesExams;?>/'+msg.dataPregs[i].archivo+'" class="img-responsive center-block img-rounded" >'
                                            +'</div>';
                                    }
                                }
                                $(newPreg).appendTo("#dataExa");
                                $.each(msg.dataPregs[i].resps, function(j, item2){
                                    var newResp = '';
                                    newResp += '<div class="radio"><label>';
                                    if(msg.dataPregs[i].resps[j].archivo != null) 
                                        newResp += '<img src="../<?=$filesExams;?>/'+msg.dataPregs[i].resps[j].archivo+'" class="img-responsive center-block" >';
                                    if(msg.dataPregs[i].resps[j].seleccionada == true){
                                        newResp += '<input type="radio" name="radio" id="radio" value="'+msg.dataPregs[i].resps[j].id+'" checked>';
                                    }else{
                                        newResp += '<input type="radio" name="radio" id="radio" value="'+msg.dataPregs[i].resps[j].id+'">';
                                    }
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
    }//end session
    
    include ('footer2.php');
?>
