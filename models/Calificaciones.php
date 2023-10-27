<?php
    class calificacion extends Conectar{

        public function insert_calificacion($asig_id, $est_id, $asigxest_nota, $asigxest_est){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO asignaturaXestudiante (asigxest_id, asig_id, est_id, asigxest_nota, asigxest_est, est) 
                                VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,1);";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $asig_id);
            $sql->bindValue(2, $est_id);
            $sql->bindValue(3, $asigxest_nota);
            $sql->bindValue(4, $asigxest_est);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function calificaciones($est_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                asignaturaXestudiante.asigxest_id,
                asignaturaXestudiante.est_id,
                asignaturaXestudiante.asig_id,
                estudiante.est_id,
                estudiante.est_nom,
                estudiante.est_apep,
                estudiante.est_apem,
                asignaturas.asig_id,
                asignaturas.asig_nom,
                asignaturas.asig_alfa,
                asignaturas.asig_nrc,
                asignaturaXestudiante.asigxest_nota,
                asignaturaXestudiante.asigxest_est
                FROM asignaturaXestudiante
                INNER JOIN estudiante on asignaturaXestudiante.est_id = estudiante.est_id
                INNER JOIN asignaturas on asignaturaXestudiante.asig_id = asignaturas.asig_id
                WHERE asignaturaXestudiante.est_id = ? AND asignaturaXestudiante.est = 1";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$est_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_estudiante_asignatura($asigxest_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE asignaturaXestudiante
                SET
                    est = 0
                WHERE
                    asigxest_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $asigxest_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_estudiante_asignatura($asigxest_id, $asigxest_nota, $asigxest_est ){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE asignaturaXestudiante
                SET
                    asigxest_nota = ?,
                    asigxest_est = ?
                WHERE
                    asigxest_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $asigxest_nota);
            $sql->bindValue(2, $asigxest_est);
            $sql->bindValue(3, $asigxest_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        
    }
?>