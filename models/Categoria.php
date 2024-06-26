<?php 
    class Categoria extends Conectar{
        /* Función para insertar categoría */
        public function insert_categoria($cat_nom){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO tm_categoria(cat_id, cat_nom, fech_crea, est) 
            VALUES (NULL,?,now(),'1')";

            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$cat_nom);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* Función para actualizar categoría */
        public function update_categoria($cat_id, $cat_nom){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE tm_categoria SET 
                    cat_nom = ?
                     WHERE cat_id=?";

            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$cat_nom);
            $sql->bindValue(2,$cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_categoria($cat_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE tm_categoria SET est = 0 WHERE cat_id = ?";

            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* Listar todas las categorias */
        public function get_categoria(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM tm_categoria WHERE est = 1";

            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* Filtrar según ID de la categoría */
        public function get_categoria_id($cat_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM tm_categoria WHERE est = 1 and cat_id = ?";

            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>
