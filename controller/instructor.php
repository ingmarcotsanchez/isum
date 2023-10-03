<?php
    require_once("../config/conexion.php");
    require_once("../models/Instructor.php");
    $instructor = new Instructor();

    switch($_GET["opc"]){
        case "combo":
            $datos = $instructor->instructor();
            if(is_array($datos)==true and count($datos)<>0){
                $html = "<option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html .= "<option value='".$row['inst_id']."'>".$row['nombrei']." ".$row['ape_paternoi']."</option>";
                }
                echo $html;
            }
            break;
    }
?>