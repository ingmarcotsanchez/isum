<?php
    require_once("../config/conexion.php");
    require_once("../models/Evaluacion.php");
    $evaluacion = new Evaluacion();

    switch($_GET["opc"]){
        
        case "guardaryeditar":
            if(empty($_POST["eva_id"])){
                $evaluacion->insert_evaluacion($_POST["prof_id"],$_POST["eva_fecha"],$_POST["eva_nota"],$_POST["eva_est"]);
            }else{
                $evaluacion->update_evaluacion($_POST["eva_id"],$_POST["prof_id"],$_POST["eva_fecha"],$_POST["eva_nota"],$_POST["eva_est"]);
            }
            break;
        case "mostrar":
            $datos = $evaluacion->evaluacion_id($_POST["eva_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["eva_id"] = $row["eva_id"];
                    $output["prof_id"] = $row["prof_id"];
                    $output["eva_fecha"] = $row["eva_fecha"];
                    $output["eva_nota"] = $row["eva_nota"];
                    $output["eva_est"] = $row["eva_est"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $evaluacion->delete_evaluacion($_POST["eva_id"]);
            break;
        case "listar":
            $datos=$evaluacion->notasxprofesor();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                //columnas de las tablas a mostrar segun select del modelo
                $sub_array[] = $row["prof_nom"] ." ". $row["prof_apep"] ." ". $row["prof_apem"];
                $sub_array[] = $row["eva_fecha"];
                $sub_array[] = $row["eva_nota"];
                $sub_array[] = $row["eva_est"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["eva_id"].');"  id="'.$row["eva_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["eva_id"].');"  id="'.$row["eva_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                
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
        
        
        
            
     
    }
?>