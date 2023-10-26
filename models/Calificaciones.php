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

        public function calificaciones(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                asignaturaXestudiante.est_id,
                asignaturaXestudiante.asig_id,
                estudiante.est_id,
                estudiante.est_nom,
                estudiante.est_apep,
                estudiante.est_apem,
                asignaturas.asig_id,
                asignaturas.asig_nom,
                asignaturas.asig_alfa,
                asignaturas.asig_nrc
                FROM asignaturaXestudiante
                INNER JOIN estudiante on asignaturaXestudiante.est_id = estudiante.est_id
                INNER JOIN asignaturas on asignaturaXestudiante.asig_id = asignaturas.asig_id
                WHERE asignaturaXestudiante.est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*

        public function obtener_creditos($estudianteId){
            $conectar = parent::Conexion();
            parent::set_names();
        
                        // Realiza una consulta SQL para obtener los créditos del estudiante con el ID especificado
            $sql = "SELECT SUM(c.cal_cred) AS creditos
                    FROM calificacionxestudiante AS ce
                    LEFT JOIN calificaciones AS c ON ce.cal_id = c.cal_id
                    WHERE ce.est_id = :estudianteId";
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(":estudianteId", $estudianteId, PDO::PARAM_INT);
            $stmt->execute();

            // Verifica si se encontraron resultados
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                return $resultado['creditos'];
            } else {
                return 0; // Si no se encontraron resultados, retorna 0 créditos.
            }
        }*/
        
    }
?>