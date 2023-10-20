<?php
    class asignatura extends Conectar{
        
        public function insert_asignatura($cal_alfa,$cal_nrc,$cal_asig,$cal_cred,$cal_hor,$cal_sem,){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO calificaciones (cal_id,cal_alfa, cal_nrc, cal_asig, cal_cred, cal_hor, cal_sem, cal_est) VALUES (NULL,?,?,?,?,?,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cal_alfa);
            $sql->bindValue(2, $cal_nrc);
            $sql->bindValue(3, $cal_asig);
            $sql->bindValue(4, $cal_cred);
            $sql->bindValue(5, $cal_hor);
            $sql->bindValue(6, $cal_sem);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_asignatura($cal_id, $cal_alfa, $cal_nrc, $cal_asig, $cal_cred, $cal_hor, $cal_sem){
            $conectar=parent::Conexion();
            parent::set_names();
            $sql="UPDATE calificaciones
                SET
                    cal_alfa = ?,
                    cal_nrc = ?,
                    cal_asig = ?,
                    cal_cred = ?,
                    cal_hor = ?,
                    cal_sem = ?
                WHERE
                    cal_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cal_alfa);
            $sql->bindValue(2, $cal_nrc);
            $sql->bindValue(3, $cal_asig);
            $sql->bindValue(4, $cal_cred);
            $sql->bindValue(5, $cal_hor);
            $sql->bindValue(6, $cal_sem);
            $sql->bindValue(7, $cal_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_asignatura($cal_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE calificaciones SET cal_est=0 WHERE cal_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cal_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function asignatura(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM calificaciones WHERE cal_est = 1";
            $sql=$conectar->prepare($sql);  
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function asignatura_id($cal_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM calificaciones WHERE cal_est = 1 AND cal_id=? ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cal_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>