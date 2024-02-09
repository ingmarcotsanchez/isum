<?php
    require_once("../config/conexion.php");
    require_once("../models/Profesor.php");
    $profesor = new Profesor();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["prof_id"])){
                    $profesor->insert_profesor($_POST["prof_nom"],$_POST["prof_apep"],$_POST["prof_apem"],$_POST["prof_correo"],$_POST["prof_niv"],$_POST["prof_sex"],$_POST["prof_telf"],$_POST["rol_id"],$_POST["esc_id"],$_POST["prof_est"]);
                }else{
                    $profesor->update_profesor($_POST["prof_id"], $_POST["prof_nom"],$_POST["prof_apep"],$_POST["prof_apem"],$_POST["prof_correo"],$_POST["prof_niv"],$_POST["prof_sex"],$_POST["prof_telf"],$_POST["rol_id"],$_POST["esc_id"],$_POST["prof_est"]);
                }
                break;
        case "mostrar":
                $datos = $profesor->profesores_id($_POST["prof_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["prof_id"] = $row["prof_id"];
                        $output["prof_nom"] = $row["prof_nom"];
                        $output["prof_apep"] = $row["prof_apep"];
                        $output["prof_apem"] = $row["prof_apem"];
                        $output["prof_correo"] = $row["prof_correo"];
                        $output["prof_niv"] = $row["prof_niv"];
                        $output["prof_telf"] = $row["prof_telf"];
                        $output["rol_id"] = $row["rol_id"];
                        $output["esc_id"] = $row["esc_id"];
                        $output["prof_est"] = $row["prof_est"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $profesor->delete_profesor($_POST["prof_id"]);
                break;
        case "listar":
                $datos=$profesor->profesores2();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["prof_nom"] ." ". $row["prof_apep"] ." ". $row["prof_apem"];
                    $sub_array[] = $row["prof_correo"];
                    if($row["prof_niv"] == 'P'){
                        $sub_array[] = "Pregrado";
                    }elseif ($row["prof_niv"] == 'E'){
                        $sub_array[] = "Especialista";
                    }elseif ($row["prof_niv"] == 'M'){
                        $sub_array[] = "Magister";
                    }elseif ($row["prof_niv"] == 'D'){
                        $sub_array[] = "Doctor";
                    }else{
                        $sub_array[] = "Sin escalafón";
                    }
                    $sub_array[] = $row["prof_telf"];
                    if($row["rol_id"] == 1){
                        $sub_array[] = "Coordinador";
                    }elseif ($row["rol_id"] == 2){
                        $sub_array[] = "Profesor TC";
                    }elseif ($row["rol_id"] == 3){
                        $sub_array[] = "Profesor MT";
                    }elseif ($row["rol_id"] == 4){
                        $sub_array[] = "Profesor TP";
                    }else{
                        $sub_array[] = "Sin rol";
                    }
                    $sub_array[] = $row["esc_nombre"];
                    if($row["prof_est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='prof_ina(".$row["prof_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='prof_act(".$row["prof_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["prof_id"].');"  id="'.$row["prof_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["prof_id"].');"  id="'.$row["prof_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
        case "combo":
            $datos=$profesor->profesores();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['prof_id']."'>".$row['prof_nom']." ".$row['prof_apep']." ".$row['prof_apem']."</option>";
                }
                echo $html;
            }
            break;
        case "guardar_desde_excel":
            $profesor->insert_profesor($_POST["prof_nom"],$_POST["prof_apep"],$_POST["prof_apem"],$_POST["prof_correo"],$_POST["prof_niv"],$_POST["prof_sex"],$_POST["prof_telf"],$_POST["rol_id"],$_POST["esc_id"],$_POST["prof_est"]);
            break;
        
        case "activo":
            $profesor->update_estadoActivo($_POST["prof_id"]);
            break;
        case "inactivo":
            $profesor->update_estadoInactivo($_POST["prof_id"]);
            break; 
               
     
    }
?>