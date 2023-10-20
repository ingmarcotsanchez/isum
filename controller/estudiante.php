<?php
    require_once("../config/conexion.php");
    require_once("../models/Estudiante.php");
    $estudiante = new estudiante();

    switch($_GET["opc"]){
        
        case "guardaryeditar":
            if(empty($_POST["est_id"])){
                $estudiante->insert_estudiante($_POST["est_nom"],$_POST["est_apep"],$_POST["est_apem"],$_POST["est_correo"],$_POST["est_sex"],$_POST["est_tel"],$_POST["est_sem"]);
            }else{
                $estudiante->update_estudiante($_POST["est_id"],$_POST["est_nom"],$_POST["est_apep"],$_POST["est_apem"],$_POST["est_correo"],$_POST["est_sex"],$_POST["est_tel"],$_POST["est_sem"]);
            }
            break;
        case "mostrar":
            $datos = $estudiante->estudiante_id($_POST["est_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["est_id"] = $row["est_id"];
                    $output["est_nom"] = $row["est_nom"];
                    $output["est_apep"] = $row["est_apep"];
                    $output["est_apem"] = $row["est_apem"];
                    $output["est_correo"] = $row["est_correo"];
                    $output["est_sex"] = $row["est_sex"];
                    $output["est_tel"] = $row["est_tel"];
                    $output["est_sem"] = $row["est_sem"];
                    $output["est_estado"] = $row["est_estado"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $estudiante->delete_estudiante($_POST["est_id"]);
            break;
        case "listar":
            $datos=$estudiante->estudiante();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                //columnas de las tablas a mostrar segun select del modelo
                $sub_array[] = $row["est_nom"];
                $sub_array[] = $row["est_apep"];
                $sub_array[] = $row["est_apem"];
                $sub_array[] = $row["est_correo"];
                $sub_array[] = $row["est_sex"];
                $sub_array[] = $row["est_sem"];
                $sub_array[] = $row["est_tel"]; 
                $sub_array[] = '<button type="button" onClick="editar('.$row["est_id"].');"  id="'.$row["est_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["est_id"].');"  id="'.$row["est_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                
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