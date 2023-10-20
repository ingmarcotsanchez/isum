<?php
    class Producto extends Conectar{
        public function insert_producto($prod_nom,$prod_tipo,$prod_anno,$sem_id,$prof_id){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO productos (prod_id, prod_nom, prod_tipo, prod_anno, sem_id, prof_id, est) 
                                 VALUES (NUll,?,?,?,?,?,1);";
            
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prod_nom);
            $sql->bindValue(2, $prod_tipo);
            $sql->bindValue(3, $prod_anno);
            $sql->bindValue(4, $sem_id);
            $sql->bindValue(5, $prof_id);
            $sql->execute();
       
            return $resultado = $sql->fetchAll();
        }

        public function update_producto($prod_id,$prod_nom,$prod_tipo,$prod_anno,$sem_id,$prof_id){
          
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE productos
                SET
                    prod_nom = ?,
                    prod_tipo = ?,
                    prod_anno = ?,
                    sem_id = ?,
                    prof_id = ?
                WHERE
                    prod_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prod_nom);
            $sql->bindValue(2, $prod_tipo);
            $sql->bindValue(3, $prod_anno);
            $sql->bindValue(4, $sem_id);
            $sql->bindValue(5, $prof_id);
            $sql->bindValue(6, $prod_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_producto($prod_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE productos SET est=0 WHERE prod_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prod_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function proyecto(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM productos WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function productos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                productos.prod_id,
                productos.prod_nom,
                productos.prod_tipo,
                productos.prod_anno,
                semilleros.sem_id,
                semilleros.sem_nom,
                profesor.prof_id,
                profesor.prof_nom,
                profesor.prof_apep,
                profesor.prof_apem

                FROM productos
                INNER JOIN profesor on profesor.prof_id = productos.prof_id
                INNER JOIN semilleros on semilleros.sem_id = productos.sem_id
                WHERE productos.est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function producto_id($prod_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM productos WHERE est = 1 AND prod_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prod_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function total_productos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM productos";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>