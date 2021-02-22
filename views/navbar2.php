<nav class="navbar">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="estudiante_programa.php"><img src="../assets/img/logo.png" data-active-url="../assets/img/logo-active.png" alt=""></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-nav">
                <!-- <li><a href="#mate">Matemáticas</a></li>
                <li><a href="#esp">Español</a></li> -->
                
                <!-- <li><a href="#red">Redacción</a></li>
                <li><a href="#gen">Generales</a></li>
                <li><a href="#">IDANIS</a></li> 
                <li><a href="http://ide-educativo.com">Nosotros</a></li> -->
                <?php
                    $cadWelcome="";
                    if(isset($_SESSION['sessU'])  AND $_SESSION['sessU'] == "true"){
                        if($_SESSION['nivelEsc'] == 2){// menú secundaria
                            //$cadWelcome .= '<li><a href="#red">Redacción</a></li>';
                            //$cadWelcome .= '<li><a href="#gen">Generales</a></li>';
                            //
                            //$cadWelcome .= '<li><a href="#">IDANIS</a></li>';
                        }else if($_SESSION['nivelEsc'] == 3){// menú preparatoria
                            //$cadWelcome .= '<li><a href="#gen">Generales</a></li>';
                        }else{
                            
                        }
                        $cadWelcome .= '<li><a href="est_read_material_apoyo.php">Apoyo</a></li>';
                        $cadWelcome .= ($idUser != 0) ? '<li><a href="../controllers/get_calif_pdf.php" target="_blank">Calificaciones</a></li>' : '';
                        $cadWelcome .= ($idUser != 0) ? '<li><a href="est_read_notificaciones.php" >Notificaciones</a></li>' : '';
                        $cadWelcome .= '<li><a href="http://ide-educativo.com">Nosotros</a></li>';
                        $cadWelcome .= '<li><a href="../controllers/destroy_login.php">Salir</a></li>';
                    }else{
                        $cadWelcome.='<li><a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-blue">Iniciar Sesión</a></li>';
                    }
                    echo $cadWelcome;
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>