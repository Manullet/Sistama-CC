<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="padding-top: 20px;">
    <!-- Brand Logo -->
    <a href="bienvenida.php" class="brand-link" style="display: flex; flex-direction: column; align-items: center;">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="poppins-font-aside mb-2" style="text-align: center;">CAMBIO CLIMATICO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="padding-top: 30px;">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas/dashboard.php','content-wrapper')">
                        <i class="nav-icon bi bi-house-door"></i>
                        <p>Inicio</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a style="cursor:pointer;" class="nav-link">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>
                            Seguridad
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item nav-item-custom">
                            <a style="cursor:pointer;" class="nav-link" onclick="CargarContenido('vistas/Mantenimiento_obejetos.php','content-wrapper')">
                                <i class="nav-icon bi bi-gear"></i>
                                <p>Objetos</p>
                            </a>
                        </li>
                        <li class="nav-item nav-item-custom">
                            <a style="cursor:pointer;" class="nav-link" onclick="CargarContenido('vistas/Mantenimiento_usuarios.php','content-wrapper')">
                                <i class="nav-icon bi bi-people-fill"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>

                        <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link" onclick="CargarContenido('vistas/Mantenimiento_permisos.php','content-wrapper')">
                        <i class="nav-icon bi bi-shield-lock"></i>
                        <p>Permisos</p>
                    </a>
                </li>
                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link" onclick="CargarContenido('vistas/Mantenimiento_preguntas.php','content-wrapper')">
                        <i class="nav-icon bi bi-question-circle"></i>
                        <p>Preguntas</p>
                    </a>
                </li>
                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link" onclick="CargarContenido('vistas/Mantenimiento_roles.php','content-wrapper')">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>Roles</p>
                    </a>
                </li>
                        <!-- desde aqui se puede añadir mas Mantenimientos -->
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a style="cursor:pointer;" class="nav-link">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>
                            Fichas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                    <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas/tbl_fichas.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Fichas</p>
                    </a>
                </li>
         

                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas/tbl_categoria_fichas.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Categorias Fichas</p>
                    </a>
                </li>
                </ul>
            </li>


            <li class="nav-item has-treeview">
                    <a style="cursor:pointer;" class="nav-link">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>
                            3A1 Fermentación Estiércol
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                    <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link" onclick="CargarContenido('vistas/tbl_sector.php','content-wrapper')">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>Sector</p>
                    </a>
                </li>
         

                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link" onclick="CargarContenido('vistas/tbl_categoria_especies.php','content-wrapper')">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>Categoria Especie</p>
                    </a>
                </li>

                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link" onclick="CargarContenido('vistas/tbl_especie.php','content-wrapper')">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>Especies</p>
                    </a>
                </li>

                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link" onclick="CargarContenido('vistas/tbl_criterio_medicion.php','content-wrapper')">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>Criterios de Medición</p>
                    </a>
                </li>

                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link" onclick="CargarContenido('vistas/tbl_fermentacion_estiercol.php','content-wrapper')">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>Fermentación Estiércol</p>
                    </a>
                </li>
   
                    <li class="nav-item nav-item-custom">
                    <a href="reportes/vistaferment_est_reporte.php" class="nav-link">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>Fermentación Estiércol Reporte</p>
                    </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item has-treeview">
                    <a style="cursor:pointer;" class="nav-link">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>
                            Estiércol N20
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                    <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas/tbl_gestionmms_estiercol.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Gestión MMS Estiércol</p>
                    </a>
                </li>
         
           <!--
                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas/tbl_estiercol_n2o.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Estiércol N20</p>
                    </a>
                </li>
-->

            <!--
                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas2/tbl_sistema_mms.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Sistema MMS</p>
                    </a>
                </li>

-->

                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas/tbl_estiercol_n2o.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Estiercol N2O Medicion</p>
                    </a>
                </li>

                <li class="nav-item nav-item-custom">
                    <a href="reportes/vista_reporte_estiercoln2o.php" class="nav-link">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>Estiércol N2O Reporte</p>
                    </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview">
                    <a style="cursor:pointer;" class="nav-link">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>
                            3C1B Residuos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                    <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas2/tbl_categoria_cultivo.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Categorias Cultivos</p>
                    </a>
                </li>
         

                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas2/tbl_cultivos_medicion.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Cultivos Medición</p>
                    </a>
                </li>

                <li class="nav-item nav-item-custom">
                    <a href="reportes/vistaCultivos_Medicion.php" class="nav-link">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>Residuos Cultivos Reporte</p>
                    </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview">
                    <a style="cursor:pointer;" class="nav-link">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>
                            Encalado
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                    <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas2/tbl_tipos_cal.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Tipos de Cal</p>
                    </a>
                </li>
         

                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas2/tbl_encalado_medicion.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Encalado Medición</p>
                    </a>
                </li>

                <li class="nav-item nav-item-custom">
                    <a href="reportes/vistaEncalado_Medicion.php" class="nav-link">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>Encalado Reporte</p>
                    </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview">
                    <a style="cursor:pointer;" class="nav-link">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>
                            Urea
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                    <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas2/tbl_subcategorias_urea.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Sub-Categorias Urea</p>
                    </a>
                </li>
         

                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas2/tbl_urea_medicion.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Urea Medición</p>
                    </a>
                </li>

                <li class="nav-item nav-item-custom">
                    <a href="reportes/vistaUrea_Medicion.php" class="nav-link">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>Urea Reporte</p>
                    </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item has-treeview">
                    <a style="cursor:pointer;" class="nav-link">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>
                            Suelos Directos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                    <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas2/tbl_tipos_suelos_directos.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Tipos de Suelos Directos</p>
                    </a>
                </li>
         

                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas2/tbl_suelos_directos_medicion.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Suelos Directos Medición</p>
                    </a>
                </li>

                <li class="nav-item nav-item-custom">
                    <a href="reportes/vistaSuelosDirectos_medicion.php" class="nav-link">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>Suelos Directos Reporte</p>
                    </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview">
                    <a style="cursor:pointer;" class="nav-link">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>
                            Suelos Indirectos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                    <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas2/tbl_suelosIndirectos.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Suelos Indirectos</p>
                    </a>
                </li>
         

                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas2/vistasuelos_indirectos_reporte.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Suelos Indirectos Medición</p>
                    </a>
                </li>

                <li class="nav-item nav-item-custom">
                    <a href="reportes/vista_reportesuelos_indirectos.php" class="nav-link">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>Suelos Indirectos Reporte</p>
                    </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item has-treeview">
                    <a style="cursor:pointer;" class="nav-link">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>
                            Gestión 3C4 FON
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                    <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas2/tbl_gestionFon.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Gestión 3C4 FON</p>
                    </a>
                </li>
         

                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas2/tbl_fonMedicion.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>3C4 FON Medicion</p>
                    </a>
                </li>

                <li class="nav-item nav-item-custom">
                    <a href="reportes/vista_fon_reporte.php" class="nav-link">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>3C4 FON Reporte</p>
                    </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item has-treeview">
                    <a style="cursor:pointer;" class="nav-link">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>
                            3C4 Estiercol FPRP
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                    <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas2/tbl_estiercol_fprp.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Estiercol FPRP</p>
                    </a>
                </li>
         

                <li class="nav-item nav-item-custom">
                    <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas2/tbl_estiercol_fprp_medicion.php','content-wrapper')">
                        <i class="nav-icon bi bi bi-box-fill"></i>
                        <p>Estiercol FPRP Medición</p>
                    </a>
                </li>

                <li class="nav-item nav-item-custom">
                    <a href="reportes/vistaFPRP_medicion.php" class="nav-link">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>Estiercol FPRP Reporte</p>
                    </a>
                    </li>
                </ul>
            </li>

         

            
          
                    
                    </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Bienvenido</h5>
    </div>
</aside>
<!-- /.control-sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Mi Perfil</h5>
        <a href="modelos\cambiar_contraseña.php">Cambiar Contraseña</a>
    </div>
</aside>
<script>
    $(".nav-link").on('click', function() {
        $(".nav-link").removeClass('active');
        $(this).addClass('active');
    })
</script>