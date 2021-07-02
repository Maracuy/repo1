<?php 
    $myuser = $_SESSION['user']['id_ciudadano'];
    $sql_notif = $con->prepare('SELECT COUNT(id_tarea) FROM tareas WHERE id_ciudadano_recibe_tarea =? AND tareas.realizada = 0');
    $sql_notif->execute(array($myuser));
    $total = $sql_notif->fetch();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <form class="form-inline my-2 d-inline-block position-relative">
        <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar">
        <button class="btn position-absolute btn-search" type="submit"><i class="fas fa-search"></i></button>
      </form>


<!--Aqui esta el menu que muestra las notificaciones-->
      <div class="dropdown ml-2">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tareas <span class="badge badge-light"><?php echo $total['0']?></span>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="crea_tareas.php">Nueva Tarea Ciudadana</a>
          <a class="dropdown-item" href="crea_tareas.php">Nueva Tarea Interna</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php">Mis tareas</a>
          <a class="dropdown-item" href="tareas_archivadas.php">Realizadas</a>
        </div>
      </div>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="img/usuarios/<?php echo $_SESSION['user']['usuario_sistema'].'.jpg' ?>" alt="Falta imagen" class="img-fluid rounded-circle avatar mr-2">
            <?php 
            echo '"'.$_SESSION['user']['usuario_sistema'] . '" ' . $_SESSION['user']['nombres'];
            ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="mi_perfil.php">Perfil</a>
            <a class="dropdown-item" href="mensajes.php">Mensajes</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../cerrar.php">Cerrar Sesión</a>
          </div>
        </li>

      </ul>
    </div>
  </div>
</nav>