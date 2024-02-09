<?php
    class Profesor extends Conectar{
        public function insert_profesor($prof_nom,$prof_apep,$prof_apem,$prof_correo,$prof_niv,$prof_sex,$prof_telf,$rol_id,$esc_id,$prof_est){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO profesor (prof_id,prof_nom,prof_apep,prof_apem,prof_correo,prof_niv,prof_sex,prof_telf,rol_id,esc_id,prof_est,fech_crea, est) 
                                VALUES (NULL,?,?,?,?,?,?,?,?,?,?,now(),'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prof_nom);
            $sql->bindValue(2, $prof_apep);
            $sql->bindValue(3, $prof_apem);
            $sql->bindValue(4, $prof_correo);
            $sql->bindValue(5, $prof_niv);
            $sql->bindValue(6, $prof_sex);
            $sql->bindValue(7, $prof_telf);
            $sql->bindValue(8, $rol_id);
            $sql->bindValue(9, $esc_id);
            $sql->bindValue(10, $prof_est);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_profesor($prof_id,$prof_nom,$prof_apep,$prof_apem,$prof_correo,$prof_niv,$prof_sex,$prof_telf,$rol_id,$esc_id,$prof_est){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE profesor
                SET
                    prof_nom = ?,
                    prof_apep = ?,
                    prof_apem = ?,
                    prof_correo = ?,
                    prof_niv = ?,
                    prof_sex = ?,
                    prof_telf = ?,
                    rol_id = ?,
                    esc_id = ?,
                    prof_est = ?
                WHERE
                    prof_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prof_nom);
            $sql->bindValue(2, $prof_apep);
            $sql->bindValue(3, $prof_apem);
            $sql->bindValue(4, $prof_correo);
            $sql->bindValue(5, $prof_niv);
            $sql->bindValue(6, $prof_sex);
            $sql->bindValue(7, $prof_telf);
            $sql->bindValue(8, $rol_id);
            $sql->bindValue(9, $esc_id);
            $sql->bindValue(10, $prof_est);
            $sql->bindValue(11, $prof_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_profesor($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE profesor SET est=0 WHERE prof_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function profesores(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM profesor WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function profesores2(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                profesor.prof_id,
                profesor.prof_nom,
                profesor.prof_apep,
                profesor.prof_apem,
                profesor.prof_correo,
                profesor.prof_niv,
                profesor.prof_sex,
                profesor.prof_telf,
                profesor.rol_id,
                escalafon.esc_id,
                escalafon.esc_nombre,
                profesor.prof_est
                FROM profesor
                INNER JOIN escalafon on profesor.esc_id = escalafon.esc_id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function profesores_id($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM profesor WHERE est = 1 AND prof_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function total_profesores(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM profesor WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_estadoActivo($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE profesor SET prof_est=1 WHERE prof_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE profesor SET prof_est=0 WHERE prof_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>