<?php $empleado = $_SESSION['user']?>


<h3>Bienvenido <?php echo $empleado['nombres'] . " " . $empleado['apellido_p'] . " " . $empleado['apellido_m'] . " (" . $empleado['usuario'] . ") "  ?></h3>



<?php 

$ruta_archivo = "../admin/img/empleados/" . strtolower($empleado['usuario']). "/" . strtolower($empleado['usuario']);

?>

<img src="../admin/img/empleados/<?php echo strtolower($empleado['usuario']). "/" . strtolower($empleado['usuario'])?>.jpg" alt="imagen" class="img_perfil">


<form method="POST" action="upload.php" enctype="multipart/form-data">
    <div>
        <span>Subir </span>
        <input type="file" name="uploadedFile" />
    </div>
<input type="submit" name="uploadBtn" value="Upload" />
</form>
</body>
</html>