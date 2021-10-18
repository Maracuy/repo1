<!-- Version antigua (Solo utilizar como referencia) -->

<div class="NContenedorTabla">

<div class="NContenedorBotonesAntesTabla NcontenedorTextoTituloBotones">
    <p>
        Monitor de atención a la ciudadanía
    </p>
</div>

<div class="NContenedorBotonesAntesTabla">
    <div class="NbloqueInformacionNumeros">
        <div class="NbloqueInformacionContenido">
            <p>
                Prioritarios
            </p>
        </div>
        <div class="NbloqueInformacionContenido">
            <input type="text" class="NbloqueInformacionInput">
        </div>
    </div>
    <div class="NbloqueInformacionNumeros">
        <div class="NbloqueInformacionContenido">
            <p>
                Nuevas
            </p>
        </div>
        <div class="NbloqueInformacionContenido">
            <input type="text" class="NbloqueInformacionInput">
        </div>
    </div>
    <div class="NbloqueInformacionNumeros">
        <div class="NbloqueInformacionContenido">
            <p>
                Semanal
            </p>
        </div>
        <div class="NbloqueInformacionContenido">
            <input type="text" class="NbloqueInformacionInput">
        </div>
    </div>
    <div class="NbloqueInformacionNumeros">
        <div class="NbloqueInformacionContenido">
            <p>
                Resueltas
            </p>
        </div>
        <div class="NbloqueInformacionContenido">
            <input type="text" class="NbloqueInformacionInput">
        </div>
    </div>
    <div class="NbloqueInformacionNumeros">
        <div class="NbloqueInformacionContenido">
            <p>
                Periodo
            </p>
        </div>
        <div class="NbloqueInformacionContenido">
            <input type="text" class="NbloqueInformacionInput NbloqueInformacionInputPeriodo">
        </div>
    </div>
</div>

<div class="NContenedorBotonesAntesTabla">
    <div class="NbotonDivNuevaAccion"  id="NContenedorBotonGeneral">
        <div class="NbotonDivContenedorCosas NseparadoAncho">
            <p>
                Nuevo
            </p>
        </div>
        <div class="NbotonDivContenedorCosas" id="NContenedorBoton">
            <a href="#" class="NetiquetaANoEstilos">
                <div class="NbotonDivContenedorLista">
                    <p>
                        Usuario
                    </p>
                </div>
            </a>
            <a href="#" class="NetiquetaANoEstilos">
                <div class="NbotonDivContenedorLista">
                    <p>
                        Programa
                    </p>
                </div>
            </a>
            <a href="#" class="NetiquetaANoEstilos">
                <div class="NbotonDivContenedorLista">
                    <p>
                        Proceso
                    </p>
                </div>
            </a>
            <a href="#" class="NetiquetaANoEstilos">
                <div class="NbotonDivContenedorLista">
                    <p>
                        Queja
                    </p>
                </div>
            </a>
        </div>
    </div>
    <a class="NbotonAccionTabla">
        <p>
            Hoy
        </p>
    </a>
    <a class="NbotonAccionTabla">
        <p>
            Semanal
        </p>
    </a>
    <a class="NbotonAccionTabla">
        <p>
            Mensual
        </p>
    </a>
    <a class="NbotonAccionTabla">
        <p>
            Todo
        </p>
    </a>
    <input type="button" class="NbotonAccionTablaV2" value="Glosario" onclick="abrirModalGlosario();">
</div>

<div class="NContenedorBotonesAntesTabla">


    <table class="NRTablaBase">
        <tr>
            <th>Folio</th>
            <th>Prop</th>
            <th>Orig</th>
            <th>Soli</th>
            <th>Edad</th>
            <th>TT</th>
            <th>Benef</th>
            <th>Tel</th>
            <th>Col</th>
            <th>Afil</th>
            <th>ZN</th>
            <th>Prog</th>
            <th>Cita</th>
            <th>AV</th>
            <th>Edit</th>
        </tr>


        <?php
            include_once('Externo/consultaTabla.php');
        ?>

        
        <tr>
            <td>ID</td>
            <td>
                <a href="algunaruta" class="NRASe">
                    <span class="NRCIcon NRPeligroColor">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                </a>
                <a href="algunaruta" class="NRASe">
                    <span class="NRCIcon NRNuevoColor">
                        <i class="fas fa-star"></i>
                    </span>
                </a>
                <a href="algunaruta" class="NRASe">
                    <span class="NRCIcon NRVulColor">
                        <i class="fas fa-shield-alt"></i>
                    </span>
                </a>
                <a href="algunaruta" class="NRASe">
                    <span class="NRCIcon NREstadoColor">
                        <i class="fas fa-exclamation-circle"></i>
                    </span>
                </a>
            </td>
            <td>Origen</td>
            <td>Solicitud</td>
            <td>Edad</td>
            <td>TT</td>
            <td>Benef</td>
            <td>Tel</td>
            <td>Col</td>
            <td>Afil</td>
            <td>ZN</td>
            <td>Prog</td>
            <td>Cita</td>
            <td>AV</td>
            <td>
                <a href="algunaruta" class="NRASe">
                    <span class="NRCIcon NREstadoColor">
                    <i class="fas fa-edit"></i>
                    </span>
                </a>
            </td>
        </tr>


    </table>
</div>
</div>













<div class="NRVentanaModalContenedor" id="NRVentanaModalGlosario">
<span class="NRVentanaIconoCerrar" onclick="cerrarModalGlosario();">
    <span>X</span>
</span>
<div class="NRVentanaModal">
    <div class="NRVentanaModalContenedorTexto">
        <p><span>Icono <i class="fas fa-exclamation-triangle NRPeligroColor"></i>: </span>Urgente.</p>
    </div>
    <div class="NRVentanaModalContenedorTexto">
        <p><span>Icono <i class="fas fa-star NRNuevoColor"></i>: </span>Nuevo.</p>
    </div>
    <div class="NRVentanaModalContenedorTexto">
        <p><span>Icono <i class="fas fa-shield-alt NRVulColor"></i>: </span>Vulnerable.</p>
    </div>
    <div class="NRVentanaModalContenedorTexto">
        <p><span>Icono <i class="fas fa-exclamation-circle NREstadoColor"></i>: </span>Estado.</p>
    </div>
    <div class="NRVentanaModalContenedorTexto">
        <p><span>Orig: </span>Origen.</p>
    </div>
    <div class="NRVentanaModalContenedorTexto">
        <p><span>Soli: </span>Solicitud.</p>
    </div>
    <div class="NRVentanaModalContenedorTexto">
        <p><span>TT: </span>Titular/REPR.</p>
    </div>
    <div class="NRVentanaModalContenedorTexto">
        <p><span>Benef: </span>Beneficiario.</p>
    </div>
    <div class="NRVentanaModalContenedorTexto">
        <p><span>Tel: </span>Telefono.</p>
    </div>
    <div class="NRVentanaModalContenedorTexto">
        <p><span>Col: </span>Colonia.</p>
    </div>
    <div class="NRVentanaModalContenedorTexto">
        <p><span>Afil: </span>Afiliación.</p>
    </div>
    <div class="NRVentanaModalContenedorTexto">
        <p><span>ZN: </span>Zona.</p>
    </div>
    <div class="NRVentanaModalContenedorTexto">
        <p><span>Prog: </span>Programa.</p>
    </div>
    <div class="NRVentanaModalContenedorTexto">
        <p><span>AV: </span>Avance.</p>
    </div>
    <div class="NRVentanaModalContenedorTexto">
        <p><span>Edit: </span>Editar propiedades.</p>
    </div>
</div>
</div>
























<script src="NuevoProgramas/Js/Modales.js">
</script>