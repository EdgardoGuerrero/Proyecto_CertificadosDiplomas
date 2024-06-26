<?php 
    /* Llamando a cadena de conexión */
    require_once("../config/conexion.php");
    /* Llamando a la clase */
    require_once("../models/Instructor.php");
    /* Inicalizando clase */
    $instructor = new Instructor();

    /* Opción de solicitud de controller */
    switch($_GET["op"]){
        case "guardaryeditar":
            if(empty($_POST["inst_id"])){
                $instructor->insert_instructor(
                    $_POST["inst_nom"],
                    $_POST["inst_apep"],
                    $_POST["inst_apem"],
                    $_POST["inst_correo"],
                    $_POST["inst_sex"],
                    $_POST["inst_telf"]
                );
            }else{
                $instructor->update_instructor(
                    $_POST["inst_id"],
                    $_POST["inst_nom"],
                    $_POST["inst_apep"],
                    $_POST["inst_apem"],
                    $_POST["inst_correo"],
                    $_POST["inst_sex"],
                    $_POST["inst_telf"]
                );
            }
            break;

        /* Creando Json según el ID */
        case "mostrar":
            $datos = $instructor->get_instructor_id($_POST["inst_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["inst_id"] = $row["inst_id"];
                        $output["inst_nom"] = $row["inst_nom"];
                        $output["inst_apep"] = $row["inst_apep"];
                        $output["inst_apem"] = $row["inst_apem"];
                        $output["inst_correo"] = $row["inst_correo"];
                        $output["inst_sex"] = $row["inst_sex"];
                        $output["inst_telf"] = $row["inst_telf"];
                    }
                    echo json_encode($output);
                }
            break;
        
        /* Eliminar según ID */
        case "eliminar":
            $instructor->delete_instructor($_POST["inst_id"]);
            break;

        /* Listar toda la información según formato de datatable */
        case "listar":
            $datos = $instructor->get_instructor();
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["inst_nom"];
                $sub_array[] = $row["inst_apep"];
                $sub_array[] = $row["inst_apem"];
                $sub_array[] = $row["inst_correo"];
                $sub_array[] = $row["inst_telf"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["inst_id"].')"  id="'.$row["inst_nom"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["inst_id"].')"  id="'.$row["inst_nom"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data
            );
            echo json_encode($results);
            break;

        case "combo":
            $datos=$instructor->get_instructor();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['inst_id']."'>".$row['inst_nom']." ".$row['inst_apep']." ".$row['inst_apem']."</option>";
                }
                echo $html;
            }
            break;
    }
?>