<!-- Seccion de filtros -->
<div class="ContenedorBannerInformacion">
    <p>
        Monitor de atención a la ciudadania
    </p>
</div>
<div class="ContenedorBannerInformacion FichaAbrirCerrarFiltros" onclick="abrirCerrarFiltros();">
    <p id="textoTituloFiltrosAC">
        Abrir filtros
    </p>
</div>
<div class="ContenedorContenidoBases contenedorVisibilidadFiltros" id="contenedorFiltrosBotonesDisplay">
    <div class="ContenedorContenidoBasesTitulo">
        <p>
            Filtros predeterminados &#40;Fecha actual&#58; <span id="idSpanFechaActual"></span>&#41;
        </p>
    </div>
    <!-- Botones predeterminados -->
    <div class="ContenedorBotonesFiltros" id="contenedorFechaPredeterminada">
        <a href="<?= $_SERVER['PHP_SELF']; ?>?tc=3" class="botonFiltro botonFiltroHover">
            Hoy
        </a>
        <a href="<?= $_SERVER['PHP_SELF']; ?>?tc=4" class="botonFiltro botonFiltroHover">
            Semanal
        </a>
        <a href="<?= $_SERVER['PHP_SELF']; ?>?tc=5" class="botonFiltro botonFiltroHover">
            Mensual
        </a>
        <a href="<?= $_SERVER['PHP_SELF']; ?>?tc=6" class="botonFiltro botonFiltroHover">
            Todo
        </a>
        <a href="<?= $_SERVER['PHP_SELF']; ?>?tc=7" class="botonFiltro botonFiltroHover">
            Urgentes
        </a>
        <a href="<?= $_SERVER['PHP_SELF']; ?>?tc=8" class="botonFiltro botonFiltroHover">
            Nuevos
        </a>
        <a href="<?= $_SERVER['PHP_SELF']; ?>?tc=9" class="botonFiltro botonFiltroHover">
            Pendientes
        </a>
    </div>
    <div class="ContenedorContenidoBasesTitulo">
        <p>
            Filtros dinámicos
        </p>
    </div>
    <!-- Botones dinamicos -->
    <div class="ContenedorBotonesFiltros" id="contenedorFechaDinamica">
        <form id="FormularioFechaDesde" method="" action="<?= $_SERVER['PHP_SELF']; ?>" onsubmit="return rellenarFechaDesde();">
            <div class="ContenedorBotonDinamicoLayout">
                <div class="ContenedorTextoBotonesIndicativos">
                    <p>
                        Fecha desde
                    </p>
                </div>
                <select class="botonFiltro" id="FechaDiaDesde">
                    <option value="" hidden selected>Dia</option>
                    <option value="01">1</option>
                    <option value="02">2</option>
                    <option value="03">3</option>
                    <option value="04">4</option>
                    <option value="05">5</option>
                    <option value="06">6</option>
                    <option value="07">7</option>
                    <option value="08">8</option>
                    <option value="09">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>
                <select class="botonFiltro" id="FechaMesDesde">
                    <option value="" hidden selected>Mes</option>
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
                <select class="botonFiltro" id="FechaAnoDesde" onclick="addYear(this);">
                    <option value="" hidden selected>Año</option>
                </select>
                <input type="submit" value="Aplicar" class="botonAplicarFiltro">
            </div>
        </form>
        <form id="FormularioFechaDesdeHasta" method="" action="<?= $_SERVER['PHP_SELF']; ?>" onsubmit="return rellenarFechaDesdeHasta();">
            <div class="ContenedorBotonDinamicoLayout">
                <div class="ContenedorTextoBotonesIndicativos">
                    <p>
                        Fecha desde
                    </p>
                    <!--   <input type="date" value="Fecha" data-date-format="YYYY-MM-DD" class="botonFiltro" >-->
                    <select class="botonFiltro" id="FechaDiaDesdeH">
                        <option value="" hidden selected>Dia</option>
                        <option value="01">1</option>
                        <option value="02">2</option>
                        <option value="03">3</option>
                        <option value="04">4</option>
                        <option value="05">5</option>
                        <option value="06">6</option>
                        <option value="07">7</option>
                        <option value="08">8</option>
                        <option value="09">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                    <select class="botonFiltro" id="FechaMesDesdeH">
                        <option value="" hidden selected>Mes</option>
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                    <select class="botonFiltro" id="FechaAnoDesdeH" onclick="addYear(this);">
                        <option value="" hidden selected>Año</option>
                    </select>
                    <div class="ContenedorTextoBotonesIndicativos">
                        <p>
                            Hasta
                        </p>
                    </div>
                    <select class="botonFiltro" id="FechaDiaHastaH">
                        <option value="" hidden selected>Dia</option>
                        <option value="01">1</option>
                        <option value="02">2</option>
                        <option value="03">3</option>
                        <option value="04">4</option>
                        <option value="05">5</option>
                        <option value="06">6</option>
                        <option value="07">7</option>
                        <option value="08">8</option>
                        <option value="09">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                    <select class="botonFiltro" id="FechaMesHastaH">
                        <option value="" hidden selected>Mes</option>
                        <option value="01">enero</option>
                        <option value="02">febrero</option>
                        <option value="03">marzo</option>
                        <option value="04">abril</option>
                        <option value="05">mayo</option>
                        <option value="06">junio</option>
                        <option value="07">julio</option>
                        <option value="08">agosto</option>
                        <option value="09">septiembre</option>
                        <option value="10">octubre</option>
                        <option value="11">noviembre</option>
                        <option value="12">diciembre</option>
                    </select>
                    <select class="botonFiltro" id="FechaAnoHastaH" onclick="addYear(this);">
                        <option value="" hidden selected>Año</option>
                    </select>
                    <input type="submit" value="Aplicar" class="botonAplicarFiltro">
                </div>
        </form>
    </div>
</div>
</div>