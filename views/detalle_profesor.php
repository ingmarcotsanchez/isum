<?php
define( "BASE_URL", "/ISUM/views/");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");
require_once("../models/Profesor.php");
    $profesor = new Profesor();
    $prof = $profesor->get_profesorDetallexid($_GET['prof_id']);
if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include("modulos/head.php");
  ?>
  <title>Proyecto | Perfil</title>
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
            <?php for($i=0;$i<sizeof($prof);$i++): ?>
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="br-mainpanel br-profile-page">
                        <div class="card shadow-base bd-0 rounded-0 widget-4">
                            <div class="card-header ht-75"></div>
                            <div class="card-body">
                                <div class="card-profile-img">
                                    <img src='<?php echo $prof[$i]["prof_image"];?>' alt="foto de perfil">
                                </div>
                                <h4 class="tx-normal tx-roboto tx-white"><?php echo $prof[$i]["prof_nom"] ." ". $prof[$i]["prof_apep"] ." ". $prof[$i]["prof_apem"]; ?></h4>
                                <?php
                                    if($prof[$i]["prof_niv"] == 'P'){ ?>
                                    <p class="mg-b-25"> Profesional </p>
                                <?php
                                    }elseif ($prof[$i]["prof_niv"] == 'E'){?>
                                        <p class="mg-b-25"> Especialista </p>
                                <?php
                                    }elseif ($prof[$i]["prof_niv"] == 'M'){?>
                                        <p class="mg-b-25"> Magister </p>
                                <?php
                                    }elseif ($prof[$i]["prof_niv"] == 'D'){?>
                                        <p class="mg-b-25"> Doctor </p>
                                <?php
                                    }else{?>
                                        <p class="mg-b-25"> Sin estudios </p>
                                <?php
                                    }
                                ?> 
                            </div>
                        </div>
                    </div>

                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-light">
                                        <div class="card-header">
                                            <h3 class="card-title">Información General</h3>
                                        </div>
                                        <div class="card-body">
                                            <strong>CORREO ADMINISTRATIVO</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_correo"];?></p>
                                            <strong>CORREO ACADÉMICO</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_correo2"];?></p>
                                            <strong>ESCALAFÓN</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["esc_nombre"];?></p>
                                            <strong>CARGO</strong>
                                            <?php
                                                if($prof[$i]["rol_id"] == 1){ ?>
                                                <p class="mg-b-25"> Coordinador </p>
                                            <?php
                                                }elseif ($prof[$i]["rol_id"] == 2){?>
                                                    <p class="mg-b-25"> Profesor Tiempo Completo </p>
                                            <?php
                                                }elseif ($prof[$i]["rol_id"] == 3){?>
                                                    <p class="mg-b-25"> Profesor Medio Tiempo </p>
                                            <?php
                                                }elseif ($prof[$i]["rol_id"] == 4){?>
                                                    <p class="mg-b-25"> Profesor Catedratico </p>
                                            <?php
                                                }else{?>
                                                    <p class="mg-b-25"> Sin escalafón </p>
                                            <?php
                                                }
                                            ?>
                                            <strong>TELÉFONO</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_telf"];?></p>
                                            <strong>FECHA DE INGRESO</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_fecini"];?></p>
                                            <strong>FECHA DE RETIRO</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_fecfin"];?></p>
                                            <hr>
                                            <strong>CVLAC</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_cvlac"];?></p>
                                            <strong>ORCID</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_orcid"];?></p>
                                            <strong>GOOGLE SCHOLAR</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_google"];?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header p-2">
                                           <strong>Evaluaciones</strong>
                                        </div><!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="row">   
                                                <div class="col-12 col-sm-6 col-md-4">
                                                    <div class="info-box">
                                                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-thumbs-up"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">2021-60</span>
                                                            <span class="info-box-number">3.5</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-4">
                                                    <div class="info-box">
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">2022-10</span>
                                                            <span class="info-box-number">2.5</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
            <?php endfor; ?>
        </div>
        <?php
            include("modulos/footer.php");
        ?>
    </div>
    <!-- /.Site warapper -->
    <?php
    include("modulos/js.php");
    ?>
    <script type="text/javascript" src="js/perfil.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
