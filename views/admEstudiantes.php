<?php
define( "BASE_URL", "/ISUM/views/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include("modulos/head.php");
  ?>
  <title>Proyecto | Reportes</title>
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
                    <h1>Estudiantes</h1>
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

    <script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
    </script>
</body>
</html>
