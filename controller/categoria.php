<?php 
    /* Llamando a cadena de conexión */
    require_once("../config/conexion.php");
    /* Llamando a la clase */
    require_once("../models/Categoria.php");
    /* Inicalizando clase */
    $categoria = new Categoria();

    /* Opción de solicitud de controller */
    switch($_GET["op"]){
        case "guardaryeditar":
            if(empty($_POST["cur_id"])){
                $curso->insert_curso(
                    $_POST["cat_id"],
                    $_POST["cur_nom"],
                    $_POST["cur_descrip"],
                    $_POST["cur_fechini"],
                    $_POST["cur_fechfin"],
                    $_POST["inst_id"]
                );
            }else{
                $curso->update_curso(
                    $_POST["cur_id"],
                    $_POST["cat_id"],
                    $_POST["cur_nom"],
                    $_POST["cur_descrip"],
                    $_POST["cur_fechini"],
                    $_POST["cur_fechfin"],
                    $_POST["inst_id"]
                );
            }
            break;

        /* Creando Json según el ID */
        case "mostrar":
            $datos = $curso->get_curso_id($_POST["cur_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["cur_id"] = $row["cur_id"];
                        $output["cat_id"] = $row["cat_id"];
                        $output["cur_nom"] = $row["cur_nom"];
                        $output["cur_descrip"] = $row["cur_descrip"];
                        $output["cur_fechini"] = $row["cur_fechini"];
                        $output["cur_fechfin"] = $row["cur_fechfin"];
                        $output["inst_id"] = $row["inst_id"];
                    }
                    echo json_encode($output);
                }
            break;
        
        /* Eliminar según ID */
        case "eliminar":
            $curso->delete_curso($_POST["cur_id"]);
            break;

        /* Listar toda la información según formato de datatable */
        case "listar":
            $datos = $curso->get_curso();
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["cat_id"];
                $sub_array[] = $row["cur_nom"];
                $sub_array[] = $row["cur_fechini"];
                $sub_array[] = $row["cur_fechfin"];
                $sub_array[] = $row["inst_id"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["cur_id"].')"  id="'.$row["cur_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["cur_id"].')"  id="'.$row["cur_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
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
            $datos = $categoria->get_categoria();
            if(is_array($datos)==true and count($datos)>0){
                $html = " <option label='Seleccione'></option>";

                foreach($datos as $row){
                    $html.="<option value='".$row['cat_id']."'>".$row["cat_nom"]."</option>";
                }

                echo $html;
            }
            break;
    }
?>