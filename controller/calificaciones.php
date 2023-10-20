<?php
        require_once("../config/conexion.php");
        require_once("../models/Calificaciones.php");
        $calificacion = new calificacion();

        switch($_GET["opc"]){
            
            case "listar":
                $datos=$calificacion->calificacion();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["est_id"];
                    $sub_array[] = $row["est_nom"];
                    $sub_array[] = $row["cal_asig"];
                    $sub_array[] = $row["cal_cred"];
                    $sub_array[] = $row["cal_hor"];
                    $sub_array[] = $row["cal_sem"];
                    $sub_array[] = $row["calxest_fecha"];
                    $sub_array[] = '<button type="button" onClick="editar('.$row["calxest_id"].');"  id="'.$row["calxest_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["calxest_id"].');"  id="'.$row["calxest_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
                    $data[] = $sub_array;
                }
                /*Formato del datatable, se usa siempre*/
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
                break;

            case "obtener_estudiantes":
                $datos = $calificacion->obtenerEstudiantes();
                echo json_encode($datos);
                break;
            case "obtener_creditos":
                if (isset($_POST["estudianteId"])) {
                    $estudianteId = $_POST["estudianteId"];
                    $creditos = $calificacion->obtener_creditos($estudianteId);
                
                    $response = [
                        "success" => true,
                        "creditos" => $creditos
                    ];
                
                    echo json_encode($response);
                } else {
                    $response = [
                        "success" => false,
                        "message" => "ID de estudiante no proporcionado."
                    ];
                
                    echo json_encode($response);
                }
                break;
        }
        
?> 