<?php
        require_once("../config/conexion.php");
        require_once("../models/Calificaciones.php");
        $calificacion = new calificacion();

        switch($_GET["opc"]){
            case "guardaryeditar":
                if(empty($_POST["est_id"])){
                    $calificacion->insert_calificacion($_POST["asig_id"],$_POST["est_id"],$_POST["asigxest_nota"],$_POST["asigxest_est"]);
                }/*else{
                    $calificacion->update_calificacion($_POST["asig_id"],$_POST["est_id"],$_POST["asigxest_califica"],$_POST["est"]);
                }*/
                break;
            
            case "listar":
                $datos=$calificacion->calificaciones($_POST["est_id"]);
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["est_nom"] ." ". $row["est_apep"] ." ". $row["est_apem"];
                    $sub_array[] = $row["asig_nom"] ." - ". $row["asig_alfa"] ." - ". $row["asig_nrc"];
                    $sub_array[] = $row["asigxest_nota"];
                    if($row["asigxest_est"] == 1){
                        $sub_array[] = "<b style='color:green'>Aprobada</b>";
                    }else{
                        $sub_array[] = "<b style='color:red'>Reprobada</b>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["asigxest_id"].');"  id="'.$row["asigxest_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["asigxest_id"].');"  id="'.$row["asigxest_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
                    $data[] = $sub_array;
                }
          
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
                break;
            case "eliminar_estudiante_asignatura":
                $calificacion->delete_estudiante_asignatura($_POST["asigxest_id"]);
                break;
            /*TODO: Insetar detalle de curso usuario */
            case "editar_estudiante_asignatura":
                /*TODO: Array de usuario separado por comas */
                $datos = explode(',', $_POST['asig_id']);
                /*TODO: Registrar tantos usuarios vengan de la vista */
                $data = Array();
                foreach($datos as $row){
                    $sub_array = array();
                    $idx=$calificacion->update_estudiante_asignatura($asigxest_id, $asigxest_nota, $asigxest_est);
                    $sub_array[] = $idx;
                    $data[] = $sub_array;
                }
    
                echo json_encode($data);
                break;

/*
           
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