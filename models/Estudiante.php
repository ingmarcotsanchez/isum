<?php
    class estudiante extends Conectar{
        
        
        public function insert_estudiante($est_nom,$est_apep,$est_apem,$est_correo,$est_sex,$est_tel,$est_sem){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO estudiantes (est_id, est_nom, est_apep, est_apem, est_correo, est_sex, est_tel, est_sem,est_estado) VALUES (NULL,?,?,?,?,?,?,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $est_nom);
            $sql->bindValue(2, $est_apep);
            $sql->bindValue(3, $est_apem);
            $sql->bindValue(4, $est_correo);
            $sql->bindValue(5, $est_sex);
            $sql->bindValue(6, $est_tel);
            $sql->bindValue(7, $est_sem);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_estudiante($est_id, $est_nom, $est_apep, $est_apem, $est_correo, $est_sex, $est_tel, $est_sem){
            $conectar=parent::Conexion();
            parent::set_names();
            $sql="UPDATE estudiantes
                SET
                    est_nom = ?,
                    est_apep = ?,
                    est_apem = ?,
                    est_correo = ?,
                    est_sex = ?,
                    est_tel = ?,
                    est_sem = ?
                WHERE
                    est_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $est_nom);
            $sql->bindValue(2, $est_apep);
            $sql->bindValue(3, $est_apem);
            $sql->bindValue(4, $est_correo);
            $sql->bindValue(5, $est_sex);
            $sql->bindValue(6, $est_tel);
            $sql->bindValue(7, $est_sem);
            $sql->bindValue(8, $est_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_estudiante($est_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE estudiantes SET est_estado=0 WHERE est_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$est_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function estudiante(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM estudiantes WHERE est_estado = 1";
            $sql=$conectar->prepare($sql);  
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function estudiante_id($est_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM estudiantes WHERE est_estado = 1 AND est_id=? ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$est_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>