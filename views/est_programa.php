<?php
    include ('header.php');
    include('../config/variables.php');
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
    }else if($_SESSION['perfil'] != 3){
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>¿Estás tratando de acceder? No es tu perfil o(´^｀)o </h2></div></div>';
    }else {
        $idUser = $_SESSION['userId'];
        unset ( $_SESSION['exaRand'] );
        unset ( $_SESSION['exeRand'] );
?>

    <div class="container">
        <div class="row text-center"><h1>Guía de estudio</h1></div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="data">
                <thead>
                    <tr>
                        <th>Tema</th>
                        <th>Ejercicios</th>
                        <th>Examen</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        
    </div>

    <script type="text/javascript">
        $('#loading').hide();
        var ordenar = '';
        function show_hide_row(row){
                $("."+row).toggle();
            }
            
        $(document).ready(function(){
           filtrar();
           function filtrar(){
               $.ajax({
                   type: "POST",
                   data: {idUser: <?=$idUser;?>}, 
                   url: "../controllers/get_programa.php",
                   success: function(data){
                        console.log(data);
                        $("#data tbody").html("");
                        var msg = jQuery.parseJSON(data);
                        if(msg.error == 0){
                            var cadRes = '';
                            $.each(msg.dataRes, function(i, item){
                                cadRes += '';
                                $.each(msg.dataRes[i].mats, function(j, item){
                                    cadRes += '<tr class="matMas" >'
                                        +'<td><b class="masMatMas">+</b>'+msg.dataRes[i].mats[j].nameMat+'</td></tr>';
                                    $.each(msg.dataRes[i].mats[j].ejes, function(k, item){
                                        cadRes += '<tr class="eje" style="display:none">'
                                                +'<td>&nbsp;&nbsp;&nbsp;&nbsp;<span class="masEjeMas">+</span>'
                                                +msg.dataRes[i].mats[j].ejes[k].nameEje+'</td></tr>';
                                        $.each(msg.dataRes[i].mats[j].ejes[k].nivs, function(l, item){
                                            cadRes += '<tr class="niv" style="display:none">'
                                            //cadRes += '<tr class="niv" >'
                                                    +'<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\-'
                                                    +msg.dataRes[i].mats[j].ejes[k].nivs[l].nameNiv+'</td>';
                                                    
                                                    if(msg.dataRes[i].mats[j].ejes[k].nivs[l].disp == true){
                                                        cadRes += '<td>('+msg.dataRes[i].mats[j].ejes[k].nivs[l].scoreEx+'/10) '
                                                            +'<a href="est_read_exe.php?idNivel='+msg.dataRes[i].mats[j].ejes[k].nivs[l].idNiv+'&idUser=<?=$idUser;?>" class="btn btn-default">'
                                                            +'<img src="../assets/obj/unlock.png" width="25px"></a></td>'
                                                            +'<td>('+msg.dataRes[i].mats[j].ejes[k].nivs[l].score+'/10) ';
                                                        if(parseInt(msg.dataRes[i].mats[j].ejes[k].nivs[l].score) >= 6){
                                                            cadRes += ' <a href="est_read_exam.php?idNivel='+msg.dataRes[i].mats[j].ejes[k].nivs[l].idNiv+'&idUser=<?=$idUser;?>" class="btn btn-success"> '; 
                                                            cadRes += '<img src="../assets/obj/unlock.png" width="25px"></td>'
                                                            +'</a>';
                                                        }else if(parseInt(msg.dataRes[i].mats[j].ejes[k].nivs[l].score) >= 1 && parseInt(msg.dataRes[i].mats[j].ejes[k].nivs[l].score) <=5){
                                                            cadRes += '<a href="est_read_exam.php?idNivel='+msg.dataRes[i].mats[j].ejes[k].nivs[l].idNiv+'&idUser=<?=$idUser;?>" class="btn btn-danger"> ';
                                                            cadRes += '<img src="../assets/obj/unlock.png" width="25px"></td>'
                                                            +'</a>';
                                                        }else if(parseInt(msg.dataRes[i].mats[j].ejes[k].nivs[l].score) == 0 ){
                                                            cadRes+= '<a href="est_read_exam.php?idNivel='+msg.dataRes[i].mats[j].ejes[k].nivs[l].idNiv+'&idUser=<?=$idUser;?>" class="btn btn-default"> ';
                                                            cadRes += '<img src="../assets/obj/unlock.png" width="25px"></td>'
                                                            +'</a>';
                                                        }else{
                                                            
                                                        }    
                                                    }else{
                                                        cadRes += '<td><button class="btn btn-default" disabled> '
                                                            +' <img src="../assets/obj/padlock.png" width="25px"></td>'
                                                            +'</button></td>';
                                                            +'<td>('+msg.dataRes[i].mats[j].ejes[k].nivs[l].score+'/10) ';
                                                        cadRes += '<td><button class="btn btn-default" disabled> '
                                                            +' <img src="../assets/obj/padlock.png" width="25px"></td>'
                                                            +'</button></td>';
                                                    }
                                                    cadRes += '</tr>';
                                        });
                                        //cadRes += '</ul></li>';
                                    });
                                    //cadRes += '</ul></li>';
                                });
                                //cadRes += '</ul>';
                            });
                            //console.log(cadRes);
                            $("#data tbody").html(cadRes);
                        }else{
                            $("#data tbody").html('<h2>'+data.msgErr+'</h2>');
                        }
                   }//end success
               });
           }//end filtrar 

           $("#data tbody").on("click", ".matMas", function(){
                $(this).closest("tr").nextUntil(".matMas").toggle();
                $(".niv").hide();
                /*if($(".eje").is(":visible")){ 
                    $(this).children($(".masMatMas span")).prepend("+");
                }    
                else{
                    $(this).children($(".masMatMas span")).prepend("-");
                }*/
           })
           $("#data tbody").on("click", ".eje", function(){
                $(this).closest("tr").nextUntil("tr:not(.niv)").toggle();
                //if($(".niv").is(":visible")) alert("V");
                //else alert("F");
           })
           
        });
    </script>
    
<?php
    }//end if-else
    include ('footer.php');
?>
