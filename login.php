<?php  session_start();
include("../Admin/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>

<script src="../Alert/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="../Alert/sweetalert.css">

  <script type="text/javascript">
function JSalert(dato){
	swal("ACEPTADO", dato, "success");
}
</script>

<script type="text/javascript">
function JSalert_Error(dato){
  swal("ERROR", dato, "error");   
  }
</script>


<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

 <!-- ESTILO CURSOS DE PROGRAMACION -->
 <link rel="stylesheet" href="../css/style_cp.css">

<title>Insertar Datos</title>
</head>
<body>

<?php 
//login///////////////////////////

if (!isset($_SESSION["user_cursos"])){$_SESSION["user_cursos"] = '';}
if ($_SESSION["user_cursos"] == ''){
  if(!empty($_POST))
  {

    

    if(trim($_POST["nombre"]) != "" && trim($_POST["pass"]) != ""){


$key =  'I1NiIsInR5cCI0NjbEwvRGtwbGhXY2xML0RrcJzdWIiOiIxMjM0NTY3O';
$nombre = $_POST["nombre"];
$password = $_POST["pass"];

$result = mysqli_query($conexion,"SELECT nombre, (AES_DECRYPT(from_base64(pass), '$key'))pass FROM datos_usuario_cp WHERE nombre = '$nombre'");
if($row = mysqli_fetch_array($result)){
   
    if($row["pass"] == $password){
        $_SESSION["user_cursos"] = $row['nombre'];
        $_SESSION["pass_cursos"] = $row['pass'];
        echo '<script>JSalert("Estamos LOGIN");</script>';

    }else{
     echo '<script>JSalert_Error("Pass incorrecto");</script>';     
    }
}else{
 echo '<script>JSalert_Error("El usuario no existe");</script>';
}
mysqli_free_result($result);
}else{
echo '<script>JSalert_Error("Usuario o contraseña incompletos");</script>';
}


}
}

?>


<!-- NAVBAR -->
<?php include("../Admin/navbar.php"); ?>
<!-- END NAVBAR -->


<div class="container" style="justify-content: center; margin: 0 auto; position: relative;">


<?php 

  if(!empty($_SESSION))
  {
   
  if ( $_SESSION["user_cursos"] == "" OR !isset($_SESSION['user_cursos']) ) {
//    echo 'Sin sesión'; 
?>
  
  <div class="card mi_card" >
<div class="mb-4">
  <p style="font-weight: bold; color: #0F6BB7; font-size: 22px;">LOGIN</p>
</div>
<form class="row g-3 needs-validation" action="login.php" method="POST" novalidate>
<input type="hidden" name="dato" value="insertar" >
  <div class="col-md-6">
    <label for="validationCustom01" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="validationCustom01" name="nombre"  required>
    <div class="valid-feedback">
    Correcto!
    </div>
      <div class="invalid-feedback">
      Por favor, inserte su nombre.
      </div>
  </div>
  <div class="col-md-6">
    <label for="validationCustom04" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="validationCustom04" name="pass"  required>
    <div class="valid-feedback">
    Correcto!
    </div>
      <div class="invalid-feedback">
      Por favor, inserte su teléfono.
      </div>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Login</button>
  </div>
  <a href="index.php"><p>Registrar usuario</p></a>
</form>
</div>

<?php
 }else{
  
  //  echo 'Sesión OK';
  $result_query = mysqli_query($conexion,"SELECT nombre FROM datos_usuario_cp WHERE nombre = '".$_SESSION["user_cursos"]."' ");
 if($row_query = mysqli_fetch_array($result_query)){}
 ?>

<div class="card mi_card" >
<div class="mb-4">
  <p style="font-weight: bold; color: #0F6BB7; font-size: 22px;">Bienvenido <?php echo $row_query["nombre"]; ?></p>
</div>
  <div class="col-12">
  <a class="btn btn-danger" href="cerrarsesion.php" type="submit">Cerrar sessión</a>
  </div>
  <a class="mt-4" href="index.php"><p>volver</p></a>
</div>


 <?php
 
  }
}
?>




</div>













<script>
(function () {
  'use strict'
  
  var forms = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>







<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>

</body>
</html>


