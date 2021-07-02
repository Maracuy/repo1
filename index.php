<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if (isset($_SESSION['user'])){
header("Location: admin/index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Administración de beneficiarios</title>
    <link rel="stylesheet" type="text/css" href="estilo_login.css" media="screen" />
    <script src="https://kit.fontawesome.com/d0baa1aa63.js" crossorigin="anonymous"></script>

</head>
<body>
    <?php include 'menu_superior.html'?>
    <div class="division"></div>
    
    <?php
    if($_GET){
        if($_GET['fail'] == 1){
            echo 'Contraseña incorrecta';
        }
        if ($_GET['fail'] == 2) {
            echo 'Usuario no existe';
        }
    }
?>
    <form class="formulario" action="iniciosesion.php" method="POST">
        <h1>Login</h1>
        <div class="contenedor">
            <div class="input-contenedor">
                <i class="fas fa-user icon"></i>
                <input type="text" autofocus name="usuario" placeholder="Usuario">
            </div>
            <div class="input-contenedor">
                <i class="fas fa-key icon"></i>
                <input type="password" name="password" placeholder="Contraseña">
            </div>
            <input type="submit" value="Entrar" class="button">
            <p>Al entrar, aceptas los Terminos y Condiciones</p>
        </div>
    </form>

<script>
function myFunction() {
  alert("Hello! I am an alert box!");
}
</script>


</body>
</html>