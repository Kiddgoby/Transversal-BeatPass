<?phprequire_once 'modelo/Usuario.php';

class Controlador {
    
    public function procesarLogin() {
        $mensaje = "";
        $acceso = false;
        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = isset($_POST['gmail']) ? $_POST['gmail'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            
        
            $usuario = new Usuario($correo, $password);
            
        if ($usuario->validarCredenciales()){


            $acceso = true;
            $mensaje = "¡Acceso conedido!";

            session_start();
            $_SESSION['usuario']=$correo;
            $_SESSION['autenticado']= true;

        }    


}