<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UserController = new UserController();

    if (isset($_POST["Crear"])) {
        $UserController ->crear();
        echo __LINE__;
    }elseif (isset($_POST["Leer"])) {
        $UserController -> leer();
        echo __LINE__;
    }elseif (isset($_POST["Editar"])) {
        $UserController -> editar();
        echo __LINE__;
    }elseif (isset($_POST["Eliminar"])) {
        $UserController -> eliminar();
        echo __LINE__;
    }


}

class UserController {
    private $conn;  

    // Constructor para inicializar la conexión a la base de datos
    public function __construct() {
        // Establecer conexión a la base de datos (ajusta los parámetros según tu configuración)
        $this->conn = new mysqli("localhost", "root", "", "beatpass");
        

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    // Método para obtener la conexión
    public function getConnection() {
        return $this->conn;
    }


    public function crear(): bool
    {
        // //nombre de campo form
        // $email = trim($_POST["email"]);
        // $password = trim($_POST["password"]);

        // $query = "SELECT email, contrasena FROM usuarios WHERE email = ? and contrasena = ?";
        // $stmt = $this->conn->prepare($query);
        // $stmt->bind_param("ss", $email, $password);
        // $stmt->execute();
        // $result = $stmt->get_result();

        // if ($row = $result->fetch_assoc()) {
        //     $_SESSION ["logged"] = true;
        //     $_SESSION ["email"] = $row ["email"];
        //     $_SESSION ["password"] = $row ["password"];

        //     $this->conn->close();
            
        //     header(header: "Location: ../View/Inicio/inicio.html");
            
             return true;

        // } else {
        //     $_SESSION ["logged"] = false;
        //     $_SESSION ["Login_Error"] = "Email or password are wrong";
        //     $this->conn->close();
        //     header(header: "Location: ../View/InicioSesion/index1.html");
        //     return false;
        // }

    }
    


    public function leer(): void
    {

    }

        

  
    public function editar(): void
{

}


public function eliminar(): void
{
  

    }

 
}

?>
