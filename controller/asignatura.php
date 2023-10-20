<?php
    require_once("../config/conexion.php");
    require_once("../models/Asignaturas.php");
    $asignatura = new asignatura();

    switch($_GET["opc"]){
        
        case "guardaryeditar":
            if(empty($_POST["cal_id"])){
                $asignatura->insert_asignatura($_POST["cal_alfa"],$_POST["cal_nrc"],$_POST["cal_asig"],$_POST["cal_cred"],$_POST["cal_hor"],$_POST["cal_sem"]);
            }else{
                $asignatura->update_asignatura($_POST["cal_id"],$_POST["cal_alfa"],$_POST["cal_nrc"],$_POST["cal_asig"],$_POST["cal_cred"],$_POST["cal_hor"],$_POST["cal_sem"]);
            }
            break;
        case "mostrar":
            $datos = $asignatura->asignatura_id($_POST["cal_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){

                    $output["cal_alfa"] = $row["cal_alfa"];
                    $output["cal_nrc"] = $row["cal_nrc"];
                    $output["cal_asig"] = $row["cal_asig"];
                    $output["cal_cred"] = $row["cal_cred"];
                    $output["cal_hor"] = $row["cal_hor"];
                    $output["cal_sem"] = $row["cal_sem"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $asignatura->delete_asignatura($_POST["cal_id"]);
            break;
        case "listar":
            $datos=$asignatura->asignatura();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();

                $sub_array[] = $row["cal_alfa"];
                $sub_array[] = $row["cal_nrc"];
                $sub_array[] = $row["cal_asig"];
                $sub_array[] = $row["cal_cred"];
                $sub_array[] = $row["cal_hor"];
                $sub_array[] = $row["cal_sem"]; 
                $sub_array[] = '<button type="button" onClick="editar('.$row["cal_id"].');"  id="'.$row["cal_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["cal_id"].');"  id="'.$row["cal_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                
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