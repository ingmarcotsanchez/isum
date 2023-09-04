<?php
    class Usuario extends Conectar{
        public function login(){
            $conectar = parent::Conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $usu_correo = $_POST["correo"];
                $usu_pass = $_POST["passwd"];
                if(empty($usu_correo) and empty($usu_pass)){
                    header("Location:".Conectar::ruta()."index.php?m=2");
                    exit();
                }else{
                    $sql = "SELECT * FROM usuario WHERE usu_correo=? and usu_pass=? and est=1";
                    $stmt = $conectar->prepare($sql);
                    $stmt->bindValue(1,$usu_correo);
                    $stmt->bindValue(2,$usu_pass);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    
                    if(is_array($resultado) and count($resultado)>0){
                        $_SESSION["usu_id"]=$resultado["usu_id"];
                        $_SESSION["usu_nom"]=$resultado["usu_nom"];
                        $_SESSION["usu_apep"]=$resultado["usu_apep"];
                        $_SESSION["usu_apem"]=$resultado["usu_apem"];
                        $_SESSION["usu_correo"]=$resultado["usu_correo"];
                        $_SESSION["rol_id"]=$resultado["rol_id"];
                        header("Location:".Conectar::ruta()."views/inicio.php");
                        exit();
                    }else{
                        header("Location:".Conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        }   
        
        public function insert_usuario($usu_nom,$usu_apep,$usu_apem,$usu_correo,$usu_pass,$usu_sex,$rol_id,$usu_tel,$esc_id,$usu_fecini){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO usuario (usu_id, usu_nom, usu_apep, usu_apem, usu_correo, usu_pass, usu_sex, rol_id, usu_tel, esc_id, usu_fecini, fech_crea, est) VALUES (NULL,?,?,?,?,?,?,?,?,?,?,now(),'1');";
     
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_apep);
            $sql->bindValue(3, $usu_apem);
            $sql->bindValue(4, $usu_correo);
            $sql->bindValue(5, $usu_pass);
            $sql->bindValue(6, $usu_sex);
            $sql->bindValue(7, $rol_id);
            $sql->bindValue(8, $usu_tel);
            $sql->bindValue(9, $esc_id);
            $sql->bindValue(10, $usu_fecini);
            $sql->execute();
       
            return $resultado = $sql->fetchAll();
        }

        function obtenerRoles() {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT rol_id, rol_nombre FROM rol";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_usuario($usu_id, $usu_nom, $usu_apep, $usu_apem, $usu_pass, $usu_sex, $usu_tel, $esc_id, $usu_fecfin){
            $conectar=parent::Conexion();
            parent::set_names();
            $sql="UPDATE usuario
                SET
                    usu_nom = ?,
                    usu_apep = ?,
                    usu_apem = ?,
                    usu_pass = ?,
                    usu_sex = ?,
                    usu_tel = ?,
                    esc_id = ?,
                    usu_fecfin = ?
                WHERE
                    usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_apep);
            $sql->bindValue(3, $usu_apem);
            $sql->bindValue(4, $usu_pass);
            $sql->bindValue(5, $usu_sex);
            $sql->bindValue(6, $usu_tel);
            $sql->bindValue(7, $esc_id);
            $sql->bindValue(8, $usu_fecfin);
            $sql->bindValue(9, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_usuario($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuario SET est=0 WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function usuario(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT usuario.*, escalafon.esc_nombre AS esc_nombre, rol.rol_nombre AS rol_nombre
                    FROM usuario
                    INNER JOIN escalafon ON usuario.esc_id = escalafon.esc_id
                    INNER JOIN rol ON usuario.rol_id = rol.rol_id
                    WHERE usuario.est = 1";
            $sql=$conectar->prepare($sql);  
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function usuario_id($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM usuario WHERE est = 1 AND usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function escalafon(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM escalafon WHERE est = 1 ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function rol () {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM rol";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function total_profesores(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM usuario WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_proyectos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM proyectos";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_semilleros(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM semilleros WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
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