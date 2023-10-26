<?php
        require_once("../config/conexion.php");
        require_once("../models/Calificaciones.php");
        $calificacion = new calificacion();

        switch($_GET["opc"]){
            case "guardaryeditar":
                if(empty($_POST["est_id"])){
                    $calificacion->insert_calificacion($_POST["asig_id"],$_POST["est_id"],$_POST["asigxest_califica"],$_POST["est"]);
                }/*else{
                    $calificacion->update_calificacion($_POST["asig_id"],$_POST["est_id"],$_POST["asigxest_califica"],$_POST["est"]);
                }*/
                break;
            
            case "listar":
                $datos=$calificacion->calificaciones();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["est_nom"] ." ". $row["est_apep"] ." ". $row["est_apem"];
                    $sub_array[] = $row["asig_nom"] ." - ". $row["asig_alfa"] ." - ". $row["asig_nrc"];
                    $sub_array[] = $row["asigxest_califica"];
                    if($row["est"] == 1){
                        $sub_array[] = "Aprobada";
                    }else{
                        $sub_array[] = "Reprobada";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["calxest_id"].');"  id="'.$row["calxest_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["calxest_id"].');"  id="'.$row["calxest_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
                    $data[] = $sub_array;
                }
          
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
                break;
/*
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
                */
        }
        
?> 