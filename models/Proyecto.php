<?php
    class Proyecto extends Conectar{
        public function insert_proyecto($pro_nom,$pro_anno,$prof_id,$pro_pre,$pro_prog1,$pro_prog2,$pro_prog3){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO proyectos (pro_id,pro_nom, pro_anno, prof_id, pro_pre, pro_prog1, pro_prog2, pro_prog3, est) VALUES (NUll,?,?,?,?,?,?,?,1);";
            
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $pro_nom);
            $sql->bindValue(2, $pro_anno);
            $sql->bindValue(3, $prof_id);
            $sql->bindValue(4, $pro_pre);
            $sql->bindValue(5, $pro_prog1);
            $sql->bindValue(6, $pro_prog2);
            $sql->bindValue(7, $pro_prog3);
            $sql->execute();
       
            return $resultado = $sql->fetchAll();
        }

        public function update_proyecto($pro_id,$pro_nombre,$pro_anno,$prof_id,$pro_pre,$pro_prog1,$pro_prog2,$pro_prog3){
          
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE proyectos
                SET
                    pro_nom = ?,
                    pro_anno = ?,
                    prof_id = ?,
                    pro_pre = ?,
                    pro_prog1 = ?,
                    pro_prog2 = ?,
                    pro_prog3 = ?
                WHERE
                    pro_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $pro_nombre);
            $sql->bindValue(2, $pro_anno);
            $sql->bindValue(3, $prof_id);
            $sql->bindValue(4, $pro_pre);
            $sql->bindValue(5, $pro_prog1);
            $sql->bindValue(6, $pro_prog2);
            $sql->bindValue(7, $pro_prog3);
            $sql->bindValue(8, $pro_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_proyecto($pro_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE proyectos SET est=0 WHERE pro_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$pro_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function proyecto(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM proyectos WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function proyectos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                proyectos.pro_id,
                proyectos.pro_nom,
                proyectos.pro_anno,
                profesor.prof_id,
                profesor.prof_nom,
                profesor.prof_apep,
                profesor.prof_apem,
                proyectos.pro_pre,
                proyectos.pro_prog1,
                proyectos.pro_prog2,
                proyectos.pro_prog3
                FROM proyectos
                INNER JOIN profesor on proyectos.prof_id = profesor.prof_id
                WHERE proyectos.est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function proyecto_id($pro_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM proyectos WHERE est = 1 AND pro_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$pro_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function total_proyectos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM proyectos";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>