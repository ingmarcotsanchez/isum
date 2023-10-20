<?php
define( "BASE_URL", "/ISUM/views/");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");
if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include("modulos/head.php");
  ?>
  <title>ISUM | Estudiantes X Calificaciones</title>
</head>
<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Header -->
        <?php
            include("modulos/header.php");
        ?>
        <!-- /.Header -->

        <!-- Menú -->
        <?php
            include("modulos/menu.php");
        ?>
        <!-- /.Menú -->

        <div class="content-wrapper">
            <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2"></div>
            </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Admón Calificaciones</h3>
                        </div>
                        <div class="card-body">
                            <div class="w-25 mb-2">
                                <select id="filtroCalificaciones" class="form-control mb-4"> <!-- form-control-sm para hacerla más pequeña -->
                                    <option value="">Filtrar por calificación</option>
                                </select>
                            </div>
                            <div class="input-group-append mb-4">
                                <div class="progress" style="height: 1.5rem; width: 100px;">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                </div>
                            </div>
                            <table id="calificaciones_data" class="table display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>ID Estudiante</th>
                                        <th>Nombre Estudiante</th>
                                        <th>Asignatura</th>
                                        <th>Creditos</th>
                                        <th>Horas</th>
                                        <th>Semestre</th>
                                        <th>Fecha</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
  
        <?php
            include("modulos/footer.php");
        ?>
    </div>
    <!-- /.Site wrapper -->
    <?php require_once("admCalificacionesModal.php"); ?>
    <?php include("modulos/js.php"); ?>
    <script type="text/javascript" src="js/admCalificaciones.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
