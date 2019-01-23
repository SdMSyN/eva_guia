<?php
    include ('header2.php');
    include('../config/variables.php');
?>

<title><?=$tit;?></title>
<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
<meta name="description" content="Descripción de la página" />
<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />
</head>
    <body>
        <div class="preloader">
            <img src="../assets/img/loader.gif" alt="Preloader image">
	</div>
<?php
    if (isset($_SESSION['userId'])){
        $idUser = $_SESSION['userId'];
    }else{
        $idUser = 0;
    }
    include ('navbar2.php');
?>

        <header id="intro">
            <div class="container">
                <div class="table">
                    <div class="header-text">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h3 class="light white">G. U. I. A.</h3>
                                <h1 class="white typed">Guía Universal Interactiva de Aprendizaje</h1>
                                <span class="typed-cursor">|</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <?php
            if (!isset($_SESSION['sessU'])){
                echo '<div class="row><div class="col-sm-12 text-center"><h4>No tienes permiso para entrar a esta sección. ━━[○･｀Д´･○]━━ </h4></div></div>';
            }else if($_SESSION['perfil'] != 3){
                echo '<div class="row"><div class="col-sm-12 text-center"><h4>¿Estás tratando de acceder? No es tu perfil o(´^｀)o </h4></div></div>';
            }else {
                $idUser = $_SESSION['userId'];
                unset ( $_SESSION['exaRand'] );
                unset ( $_SESSION['exeRand'] );
        ?>
        <section>
            <div class="cut cut-top"></div>
            <div class="container">
                <div class="row intro-tables">
                    <div class="col-md-4">
                        <div class="intro-table intro-table-first">
                            <h5 class="white heading hide-hover">Matemáticas</h5>
                            <div class="bottom">
                                <h4 class="white heading small-heading no-margin regular">Diviertete con los números</h4>
                                <h4 class="white heading small-pt">Secundaria</h4>
                                <a href="#mate" class="btn btn-white-fill expand">Comienza</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="intro-table intro-table-second">
                            <h5 class="white heading hide-hover">Español</h5>
                            <div class="bottom">
                                <h4 class="white heading small-heading no-margin regular">Diviertete con las letras</h4>
                                <h4 class="white heading small-pt">Secundaria</h4>
                                <a href="#esp" class="btn btn-white-fill expand">Comienza</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="intro-table intro-table-third">
                            <h5 class="white heading hide-hover">Generales</h5>
                            <div class="bottom">
                                <h4 class="white heading small-heading no-margin regular">Aprende de todo un poco</h4>
                                <h4 class="white heading small-pt">Secundaria</h4>
                                <a href="#gen" class="btn btn-white-fill expand">Comienza</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="mate" class="section">
            <div class="container">
                <div class="row text-center title">
                    <h2>Matemáticas</h2>
                    <h4 class="light muted">"El corazón de las matemáticas son sus propios problemas" [Paul Halmos]</h4>
                </div>
                <div class="row services">
                    <div class="col-md-12">
                        <div class="service">
                            <!--<div class="icon-holder">
                                <img src="../assets/img/icons/heart-blue.png" alt="" class="icon">
                            </div>
                            <h4 class="heading">Entrenamiento de Matemáticas</h4>-->
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="dataMate">
                                    <thead>
                                        <tr>
                                            <th>Tema</th>
                                            <th>Nivel I </th>
                                            <th>Nivel II</th>
                                            <th>Nivel III</th>
                                            <th>Nivel IV</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cut cut-bottom"></div>
        </section>

        <section id="esp" class="section section-padded">
            <div class="container">
                <div class="row text-center title">
                    <h2>Español</h2>
                    <h4 class="light muted">"El lenguaje es el vestido de los pensamientos" [Samuel Johnoon]</h4>
                </div>
                <div class="row services">
                    <div class="col-md-12">
                        <div class="service">
                            <!--<div class="icon-holder">
                                <img src="../assets/img/icons/heart-blue.png" alt="" class="icon">
                            </div>
                            <h4 class="heading">Entrenamiento de Español</h4>-->
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="dataEsp">
                                    <thead>
                                        <tr>
                                            <th>Tema</th>
                                            <th>Nivel I </th>
                                            <th>Nivel II</th>
                                            <th>Nivel III</th>
                                            <th>Nivel IV</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cut cut-bottom"></div>
        </section>

        <section id="red" class="section section-padded">
            <div class="container">
                <div class="row text-center title">
                    <h2>Redacción</h2>
                    <h4 class="light muted">"Los temas de la ortografía y la redacción me llama muchísimo la atención y me considero amiga número uno de los diccionarios" [María Lucía Fernández]</h4>
                </div>
                <div class="row services">
                    <div class="col-md-12">
                        <div class="service">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="dataEsp">
                                    <thead>
                                        <tr>
                                            <th>Tema</th>
                                            <th>Nivel I </th>
                                            <th>Nivel II</th>
                                            <th>Nivel III</th>
                                            <th>Nivel IV</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Pdf</td>
                                            <td><a href="../assets/obj/pt1.pdf">1</a></td>
                                            <td><a href="../assets/obj/pt2.pdf">2</a></td>
                                            <td><a href="../assets/obj/pt3.pdf">3</a></td>
                                            <td><a href="../assets/obj/pt4.pdf">4</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cut cut-bottom"></div>
        </section>
        
        <section id="gen" class="section section-padded">
            <div class="container">
                <div class="row text-center title">
                    <h2>Generales</h2>
                    <h4 class="light muted">"El conocimiento universal es distinto del particular, como lo finito de lo infinito" 
                        [Giordano Bruno]</h4>
                </div>
                <div class="row services">
                    <div class="col-md-12">
                        <div class="service">
                            <!--<div class="icon-holder">
                                <img src="../assets/img/icons/heart-blue.png" alt="" class="icon">
                            </div>
                            <h4 class="heading">Entrenamiento de Español</h4>-->
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="dataGen">
                                    <thead>
                                        <tr>
                                            <th>Tema</th>
                                            <th>Nivel I </th>
                                            <th>Nivel II</th>
                                            <th>Nivel III</th>
                                            <th>Nivel IV</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cut cut-bottom"></div>
        </section>
        
    <script type="text/javascript">
        $(document).ready(function(){
           filtrar();
           function filtrar(){
               $.ajax({
                   type: "POST",
                   data: {idUser: <?=$idUser;?>}, 
                   url: "../controllers/get_programa.php",
                   success: function(data){
                        console.log(data);
                        $("#mate #dataMate tbody").html("");
                        $("#esp #dataEsp tbody").html("");
                        $("#gen #dataGen tbody").html("");
                        var msg = jQuery.parseJSON(data);
                        if(msg.error == 0){
                            //var cadRes = '';
                            $.each(msg.dataRes, function(i, item){
                                //cadRes += '';
                                $.each(msg.dataRes[i].mats, function(j, item){
                                    var cadRes = '';
                                    $.each(msg.dataRes[i].mats[j].ejes, function(k, item){
                                        cadRes += '<tr class="eje" ><td>'
                                                +msg.dataRes[i].mats[j].ejes[k].nameEje+'</td>';
                                        $.each(msg.dataRes[i].mats[j].ejes[k].nivs, function(l, item){
                                                if(msg.dataRes[i].mats[j].ejes[k].nivs[l].disp == true){
                                                    cadRes += '<td> '
                                                        +'<a href="est_read_exe2.php?idNivel='+msg.dataRes[i].mats[j].ejes[k].nivs[l].idNiv+'&idUser=<?=$idUser;?>" class="btn btn-default btn-sm">'
                                                        +'<img src="../assets/obj/unlock.png" width="15px">('+msg.dataRes[i].mats[j].ejes[k].nivs[l].scoreEx+'/10)</a> | ';
                                                        //+'('+msg.dataRes[i].mats[j].ejes[k].nivs[l].score+'/10) ';
                                                    if(parseInt(msg.dataRes[i].mats[j].ejes[k].nivs[l].score) >= 6){
                                                        cadRes += ' <a href="est_read_exam2.php?idNivel='+msg.dataRes[i].mats[j].ejes[k].nivs[l].idNiv+'&idUser=<?=$idUser;?>" class="btn btn-success btn-sm"> '; 
                                                        cadRes += '<img src="../assets/obj/unlock.png" width="15px">('+msg.dataRes[i].mats[j].ejes[k].nivs[l].score+'/10)'
                                                        +'</a></td>';
                                                    }else if(parseInt(msg.dataRes[i].mats[j].ejes[k].nivs[l].score) >= 1 && parseInt(msg.dataRes[i].mats[j].ejes[k].nivs[l].score) <=5){
                                                        cadRes += '<a href="est_read_exam2.php?idNivel='+msg.dataRes[i].mats[j].ejes[k].nivs[l].idNiv+'&idUser=<?=$idUser;?>" class="btn btn-danger btn-sm"> ';
                                                        cadRes += '<img src="../assets/obj/unlock.png" width="15px">('+msg.dataRes[i].mats[j].ejes[k].nivs[l].score+'/10)'
                                                        +'</a></td>';
                                                    }else if(parseInt(msg.dataRes[i].mats[j].ejes[k].nivs[l].score) == 0 ){
                                                        cadRes+= '<a href="est_read_exam2.php?idNivel='+msg.dataRes[i].mats[j].ejes[k].nivs[l].idNiv+'&idUser=<?=$idUser;?>" class="btn btn-default btn-sm"> ';
                                                        cadRes += '<img src="../assets/obj/unlock.png" width="15px">('+msg.dataRes[i].mats[j].ejes[k].nivs[l].score+'/10)'
                                                        +'</a></td>';
                                                    }else{

                                                    }    
                                                }else{
                                                    cadRes += '<td><button class="btn btn-default" disabled> '
                                                        +' <img src="../assets/obj/padlock.png" width="15px">'
                                                        +'</button> | ';
                                                        +'('+msg.dataRes[i].mats[j].ejes[k].nivs[l].score+'/10) ';
                                                    cadRes += '<button class="btn btn-default" disabled> '
                                                        +' <img src="../assets/obj/padlock.png" width="15px">'
                                                        +'</button></td>';
                                                }
                                        });//end L
                                        cadRes += '</tr>';
                                    });//end K
                                    console.log(msg.dataRes[i].mats[j]);
                                    if(j == 0) $("#esp #dataEsp tbody").html(cadRes);
                                    if(j == 1) $("#mate #dataMate tbody").html(cadRes);
                                    if(j == 2) $("#gen #dataGen tbody").html(cadRes);
                                });//end J
                            });//end I
                        }else{
                            $("#mate #dataMate tbody").html('<h2>'+data.msgErr+'</h2>');
                        }
                   }//end success
               });
           }//end filtrar 
           
        });
    </script>
    
<?php
    }//end session
    
    include ('footer2.php');
?>
