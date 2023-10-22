<?php
    class Estudiante extends Conectar{
        public function insert_estudiante($est_nom,$est_apep,$est_apem,$est_correo,$est_sex,$est_telf,$est_seme){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO estudiante (est_id, est_nom, est_apep, est_apem, est_correo, est_sex, est_telf, est_seme, est) 
                                VALUES (NULL,?,?,?,?,?,?,?,1);";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $est_nom);
            $sql->bindValue(2, $est_apep);
            $sql->bindValue(3, $est_apem);
            $sql->bindValue(4, $est_correo);
            $sql->bindValue(5, $est_sex);
            $sql->bindValue(6, $est_telf);
            $sql->bindValue(7, $est_seme);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_estudiante($est_id,$est_nom,$est_apep,$est_apem,$est_correo,$est_sex,$est_telf,$est_seme){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE estudiante
                SET
                    est_nom = ?,
                    est_apep = ?,
                    est_apem = ?,
                    est_correo = ?,
                    est_sex = ?,
                    est_telf = ?,
                    est_seme = ?
                WHERE
                    est_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $est_nom);
            $sql->bindValue(2, $est_apep);
            $sql->bindValue(3, $est_apem);
            $sql->bindValue(4, $est_correo);
            $sql->bindValue(5, $est_sex);
            $sql->bindValue(6, $est_telf);
            $sql->bindValue(7, $est_seme);
            $sql->bindValue(8, $est_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_estudiante($est_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE estudiante SET est=0 WHERE est_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$est_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function estudiantes(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM estudiante WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function estudiantes_id($est_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM estudiante WHERE est = 1 AND est_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$est_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function total_estudiantes_activos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM estudiante WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_estudiantes_inactivos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM estudiante WHERE est=0";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>