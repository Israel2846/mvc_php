<?php
class Usuario extends Conectar
{
    public function login()
    {
        $conectar = parent::Conexion();
        parent::set_names();

        if (isset($_POST["enviar"])) {
            $correo_usuario = $_POST["correo_usuario"];
            $contra_usuario = $_POST["contra_usuario"];

            if (empty($correo_usuario) or empty($contra_usuario)) {
                header("Location" . Conectar::ruta() . "index.php?m=2");
                exit();
            } else {
                $sql = 'SELECT * FROM `usuario` WHERE usuario.correo_usuario = ? AND usuario.contra_usuario = ? AND usuario.estado_usuario = 1;';

                $stmt = $conectar->prepare($sql);
                $stmt->bindValue(1, $correo_usuario);
                $stmt->bindValue(2, $contra_usuario);
                $stmt->execute();

                $resultado = $stmt->fetch();

                if (is_array($resultado) and count($resultado) > 0) {
                    $_SESSION["id_usuario"] = $resultado["id_usuario"];
                    $_SESSION["nombre_usuario"] = $resultado["nombre_usuario"];
                    $_SESSION["apellido_usuario"] = $resultado["apellido_usuario"];

                    header("Location:" . Conectar::ruta() . "view/Home/");
                } else {
                    header("Location:" . Conectar::ruta() . "index.php?m=1");
                }
            }
        }
    }
}
