<?php

include('db.php');

$USUARIO=$_POST['Username'];
$PASSWORD=$_POST['Password'];

$consulta = "SELECT* FROM usuarios where Username = '$USUARIO' and password ='$PASSWORD' ";
$resultado= mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
    header("location:home.php");
    
}else{
    include("index.php");
    ?>
    <h5>Error de conexión</h5>
    <?php
    
}
mysqli_free_result($resultado);
mysqli_close($conexion);





?>