<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
if(isset($_POST['submit'])){

    $id = $_POST['id'];
    $sqlGetUser = "SELECT id, user, pass, activo FROM $tUsers WHERE id='$id' ";
    $resGetUser = $con->query($sqlGetUser);
    $rowGetUser = $resGetUser->fetch_assoc();
    
    $cad = 'Datos: <b>'.$rowGetUser['user'].' - '.$rowGetUser['pass'].'</b> ';
    $cad .= ($rowGetUser['activo'] == 1) ? '<a href="#">ACTIVO</a>' : '<a href=activar_user_id.php?id='.$rowGetUser['id'].'>ACTIVAR</a>';
    echo $cad;
    
}

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <input type="number" name="id"><br>

    <input type="submit" name="submit" value="Submit Form"><br>

</form>