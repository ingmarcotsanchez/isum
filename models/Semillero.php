<?php
    class Semillero extends Conectar{
        public function insert_semillero($sem_nom,$sem_anno,$sem_prof,$sem_linea){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO semilleros (sem_id, sem_nom, sem_anno, sem_prof, sem_linea, est) VALUES (NULL,?,?,?,?,'1');";
     
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sem_nom);
            $sql->bindValue(2, $sem_anno);
            $sql->bindValue(3, $sem_prof);
            $sql->bindValue(4, $sem_linea);
            $sql->execute();
       
            return $resultado = $sql->fetchAll();
        }

        public function update_semillero($sem_id,$sem_nombre,$sem_anno,$sem_prof,$sem_linea){
          
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE semilleros
                SET
                    sem_nombre = ?,
                    sem_anno = ?,
                    sem_prof = ?,
                    sem_linea = ?
                WHERE
                    sem_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sem_nombre);
            $sql->bindValue(2, $sem_anno);
            $sql->bindValue(3, $sem_prof);
            $sql->bindValue(4, $sem_linea);
            $sql->bindValue(5, $sem_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_semillero($sem_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE semilleros SET est=0 WHERE sem_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$sem_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function semillero(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM semilleros WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function semillero_id($sem_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM semilleros WHERE est = 1 AND sem_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$sem_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>