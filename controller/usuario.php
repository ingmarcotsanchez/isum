<?php
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");
    $usuario = new Usuario();

    switch($_GET["opc"]){
        case "inputselectEscalafon":
            $datos = $usuario->escalafon();
            if(is_array($datos)==true and count($datos)<>0){
                $html = "<option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html .= "<option value='".$row['esc_id']."'>".$row['esc_nombre']."</option>";
                }
                echo $html;
            }
            break;

        case "inputselectRol":
            $datos = $usuario->rol();
            if(is_array($datos)==true and count($datos)<>0){
                $html = "<option label='Seleccione un rol'></option>";
                foreach($datos as $row){
                    $html .= "<option value='".$row['rol_id']."'>".$row['rol_nombre']."</option>";
                }
                echo $html;
            }
            break;
        case "inputselectProfesor":
            $datos = $usuario->usuario();
            if(is_array($datos)==true and count($datos)<>0){
                $html = "<option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html .= "<option value='".$row['usu_id']."'>".$row['usu_nom']." ".$row['usu_apep']."</option>";
                }
                echo $html;
            }
            break;
        case "guardaryeditar":
            if(empty($_POST["usu_id"])){
                //$curso es la variable que tenemos inicializada, los metodos son los que creamos en el archivo de models
                $usuario->insert_usuario($_POST["usu_nom"],$_POST["usu_apep"],$_POST["usu_apem"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_sex"],$_POST["rol_id"],$_POST["usu_tel"],$_POST["esc_id"],$_POST["usu_fecfin"]);
            }else{
                $usuario->update_usuario($_POST["usu_id"],$_POST["usu_nom"],$_POST["usu_apep"],$_POST["usu_apem"],$_POST["usu_pass"],$_POST["usu_sex"],$_POST["usu_rol"],$_POST["usu_tel"],$_POST["esc_id"],$_POST["usu_fecfin"]);
            }
            break;
        case "mostrar":
            $datos = $usuario->usuario_id($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_apep"] = $row["usu_apep"];
                    $output["usu_apem"] = $row["usu_apem"];
                    $output["usu_correo"] = $row["usu_correo"];
                    $output["usu_sex"] = $row["usu_sex"];
                    $output["usu_rol"] = $row["usu_rol"];
                    $output["usu_tel"] = $row["usu_tel"];
                    $output["esc_id"] = $row["esc_id"];
                    $output["usu_fecini"] = $row["usu_fecini"];
                    $output["usu_fecfin"] = $row["usu_fecfin"];
                    $output["est"] = $row["est"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $usuario->delete_usuario($_POST["usu_id"]);
            break;
        case "listar":
            $datos=$usuario->usuario();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                //columnas de las tablas a mostrar segun select del modelo
                $sub_array[] = $row["usu_nom"];
                $sub_array[] = $row["usu_apep"];
                $sub_array[] = $row["usu_apem"];
                $sub_array[] = $row["usu_correo"];
                $sub_array[] = $row["usu_sex"];
                $sub_array[] = $row["rol_nombre"];
                $sub_array[] = $row["usu_tel"];
                $sub_array[] = $row["esc_nombre"];
                $sub_array[] = $row["usu_fecini"];
                $sub_array[] = $row["usu_fecfin"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["usu_id"].');"  id="'.$row["usu_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["usu_id"].');"  id="'.$row["usu_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                
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
        case "total_Profesores":
            $datos=$usuario->total_profesores();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_Proyectos":
            $datos=$usuario->total_proyectos();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_Semilleros":
            $datos=$usuario->total_semilleros();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_Productos":
            $datos=$usuario->total_productos();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_estudiantes":
            $datos=$usuario->total_estudiantes();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_activos":
            $datos=$usuario->total_activos();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_ausentes":
            $datos=$usuario->total_ausentes();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_desertores":
            $datos=$usuario->total_desertores();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_egresados":
            $datos=$usuario->total_egresados();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_NoGraduados":
            $datos=$usuario->total_NoGraduados();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;

       
    }
?>