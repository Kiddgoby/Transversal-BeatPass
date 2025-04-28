<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UserController = new UserController();

    if (isset($_POST["Login"])) {
        $UserController ->login();
        echo __LINE__;
    }elseif (isset($_POST["Singup"])) {
        $UserController -> singup();
        echo __LINE__;
    }elseif (isset($_POST["logout"])) {
        $UserController -> logout();
        echo __LINE__;
    }


    // $email = $_POST["email"];
    // $password = $_POST["password"];


    // if (isset($_POST["Login"])) {
    //     if ($user->login($email, $password)) {
    //         header("Location: ../View/Inicio/inicio.html");
    //         exit;
    //     } else {
    //         echo "<p>Correo o contraseña incorrectos.</p>";
    //     }
    // }

    // // if (isset($_POST["Logout"])) {
    // //     echo "<p>Logout Button is clicked.</p>";
    // //     $user->logout();
    // // }

    // if (isset($_POST["Register"])) {
    //     echo "<p>Register Button is clicked.</p>";
    //     $user->register();
    // }
}

class UserController
{
    private $conn;
    // private $email;
    // private $password;

    public function __construct()
    {
        //pasar datos de acceso
        $server_name = "localhost";
        $username = "root";
        $pass = "";
        $dbname="beatpass";
        // $this->email = $email;
        // $this->password = $password;

        // Conexión a la base de datos
        $this->conn = new mysqli("localhost", "root", "", "beatpass");

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function login(): bool
    {
        //nombre de campo form
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        $query = "SELECT email, contrasena FROM usuarios WHERE email = ? and contrasena = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $_SESSION ["logged"] = true;
            $_SESSION ["email"] = $row ["email"];
            $_SESSION ["password"] = $row ["password"];

            $this->conn->close();
            
            header(header: "Location: ../View/Inicio/inicio.html");
            
            return true;

        } else {
            $_SESSION ["logged"] = false;
            $_SESSION ["Login_Error"] = "Email or password are wrong";
            $this->conn->close();
            header(header: "Location: ../view/InicioSesion/index1.html");
            return false;
        }

    }
    


    public function logout(): void
    {
    session_unset(); // Borra todas las variables de sesión
    session_destroy(); // Destruye la sesión
    echo "Sesión cerrada.";
    header("Location: inicio.html"); 
    exit();
    }

        

    //falta acabar
    //falta acabar
    //falta acabar
    //falta acabar
    //falta acabar
    //falta acabar
    //falta acabar
    //falta acabar
    public function singup(): bool
    {
        //nombre de campo form
        $nameN = trim($_POST["nameN"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $cpassword =trim($_POST["cpassword"]);


        echo __LINE__;
        if ($password !== $cpassword){
            
            echo "Las contraseñas no coinciden";
            return false;
        };
        
        echo __LINE__;
        $query = " INSERT INTO usuarios (nameN, email, contrasena) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        echo __LINE__;
        
        if (!$stmt) {
            echo "Error al preparar la consulta: " . $this->conn->error;
            return false;
        }
        
        echo __LINE__;
        $stmt->bind_param("sss", $nameN, $email, $password);
        echo __LINE__;
        
        if ($stmt->execute()) {
            echo __LINE__;
            $_SESSION ["Singed"] = true;
            header("Location: ../View/InicioSesion/index1.html");
            return true;
            
        } else {
            echo __LINE__;
            $_SESSION ["Singed"] = false;
            echo "Error al registrar: " . $stmt->error;
            return false;
        }
    }


}

?>
