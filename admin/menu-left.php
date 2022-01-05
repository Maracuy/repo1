<div id="sidebar-container" class="bg-dark">
    <div class="logo">
            <h3 class="text-light font-weight-bold">Metepec</h3>
    </div>
    
    <div class="menu" style="position: sticky; top: 10px;">

        <?php if($_SESSION['user']['nivel'] < 8 ): // Solo los RC para arriba pueden ver esto?> 
            <a href="../admin/reportes.php" class="d-block text-light p-3"> <i class="fas fa-align-justify mr-2"></i> Reporte </a>
        <?php endif?>

        <!-- Fin programas -->
        <!-- Reconstriur esta parte con secciones (programas, monitor general, mi monitor, registrar ciudadano)-->

        <?php if($_SESSION['user']['nivel'] < 8 ): // Solo los trabajadores pueden ver esto?> 
            <a class="d-block text-light p-3"><i class="fas fa-align-justify mr-2"></i>Programas</a>
        <?php endif?>

        <?php if($_SESSION['user']['nivel'] != 4 && $_SESSION['user']['nivel'] < 6): // Solo los ENCARGADOS para arriba pueden ver esto?> 
            <a href="../admin/inicioProgramas.php?tc=6" class="d-block text-light p-3 ml-3"><i class="fas fa-tachometer-alt mr-2 ml-2"></i>Monitor general</a>
        <?php endif?>

        <?php if($_SESSION['user']['nivel'] < 8 ): // Solo los trabajadores pueden ver esto?> 
            <a href="../admin/solicitarPrograma.php" class="d-block text-light p-3 ml-3"><i class="fas fa-tachometer-alt mr-2 ml-2"></i>Solicitar</a>
        <?php endif?>

        <!-- Fin programas -->

        <?php if($_SESSION['user']['nivel'] < 4 ): // Solo los ENCARGADOS para arriba pueden ver esto?> 
            <a href="../admin/elecciones.php" class="d-block text-light p-3"> <i class="fas fa-vote-yea mr-2"></i> Electoral </a>
        <?php endif?>
        
        <?php if($_SESSION['user']['nivel'] != 4 && $_SESSION['user']['nivel'] < 6): // Solo los ENCARGADOS para arriba pueden ver esto?> 
            <a href="../admin/defensa.php" class="d-block text-light p-3 ml-3"> <i class="fas fa-user-shield mr-2"></i> Defensa </a>
        <?php endif?>

        
        <?php if($_SESSION['user']['nivel'] < 1 ): // Solo los ENCARGADOS para arriba pueden ver esto?> 
            <a href="../admin/promocion.php" class="d-block text-light p-3 ml-3"> <i class="fas fa-ad mr-2"></i> Promoción </a>
        <?php endif?>

        
        <?php if($_SESSION['user']['nivel'] < 10 && $_SESSION['user']['nivel'] != 7 ): // Solo los ENCARGADOS para arriba pueden ver esto?> 
            <a href="../admin/alta_ciudadano.php" class="d-block text-light p-3 ml-3"> <i class="fas fa-pen mr-2"></i> Captura </a>
        <?php endif?>

        <?php if($_SESSION['user']['nivel'] < 7 ): // Solo los ENCARGADOS para arriba pueden ver esto?> 
            <a href="../admin/ciudadanos.php" class="d-block text-light p-3 ml-3"> <i class="fas fa-users mr-2"></i> Prospectos </a>
        <?php endif?>

        <?php if($_SESSION['user']['nivel'] < 7 ): // Solo los ENCARGADOS para arriba pueden ver esto?> 
            <a href="../admin/alertas.php" class="d-block text-light p-3 ml-3"> <i class="fas fa-exclamation mr-2 ml-2"></i> Alertas </a>
        <?php endif?>

        <?php if($_SESSION['user']['nivel'] < 2 ): // Solo los ENCARGADOS para arriba pueden ver esto?> 
            <a href="../admin/vista_rep.php" class="d-block text-light p-3 ml-3"> <i class="fas fa-tachometer-alt mr-2 ml-2"></i> Monitor </a>
        <?php endif?>

    </div>
</div>

