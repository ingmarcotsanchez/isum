<?php
define( "BASE_URL", "/UMD/ISUM/views/");
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
  <title>Proyecto | Home</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="lbltotalProfesores"> </h3>

                <p>Total de Profesores</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="lbltotalProyectos"> </h3>

                <p>Total de Proyectos</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 id="lbltotalSemilleros"> </h3>

                <p>Total de Semilleros</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-light">
              <div class="inner">
                <h3 id="lbltotalProductos"> </h3>

                <p>Total de Productos</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          
          
              
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div>
      <div class="row">
        <div class="col-12">
          <div id="chart_div"></div>
        </div>
      </div>
    </section>
  </div>
  
  <?php
    include("modulos/footer.php");
  ?>
</div>
<!-- /.Site warapper -->
<?php
  include("modulos/js.php");
?>
<script type="text/javascript" src="js/inicio.js"></script>
<script>
  google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawColColors);

function drawColColors() {
      var data = new google.visualization.DataTable();
      data.addColumn('timeofday', 'Time of Day');
      data.addColumn('number', '1er Semestre');
      data.addColumn('number', '2do Semestre');

      data.addRows([
        [{v: [8, 0, 0], f: '2017'}, 0, 9],
        [{v: [9, 0, 0], f: '2018'}, 24, 10],
        [{v: [10, 0, 0], f:'2019'}, 10, 8],
        [{v: [11, 0, 0], f: '2020'}, 18, 6],
        [{v: [12, 0, 0], f: '2021'}, 26, 18],
        [{v: [13, 0, 0], f: '2022'}, 22, 37],
        [{v: [14, 0, 0], f: '2023'}, 37, 0],
      ]);

      var options = {
        title: 'Número de Estudiantes por semestre',
        colors: ['#9575cd', '#33ac71'],
        hAxis: {
          title: 'Año',
          format: 'YYYY-S',
          viewWindow: {
            min: [5, 30, 0],
            max: [17, 30, 0]
          }
        },
        vAxis: {
          title: 'Cantidad'
        }
      };

      

      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
</script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
