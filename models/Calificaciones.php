<?php
    class calificacion extends Conectar{
        
        public function calificacion(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT ce.calxest_id,ce.calxest_fecha, e.est_nom,e.est_id,c.cal_asig,c.cal_cred,c.cal_hor,c.cal_sem
            FROM calificacionxestudiante AS ce
            LEFT JOIN estudiantes AS e ON ce.est_id = e.est_id
            LEFT JOIN calificaciones AS c ON ce.cal_id = c.cal_id
            WHERE ce.estado = 1";
            $sql=$conectar->prepare($sql);  
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function obtenerEstudiantes(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT est_id, CONCAT(est_nom, ' ', est_apep , ' ', est_apem) AS est_nombre FROM estudiantes";
            $sql = $conectar->prepare($sql);  
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

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
        }
        
    }
?>