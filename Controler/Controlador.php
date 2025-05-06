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
    }elseif (isset($_POST["cuenta"])) {
        $UserController -> cuenta();
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
            header(header: "Location: ../View/InicioSesion/index1.html");
            return false;
        }

    }
    


    public function logout(): void
    {
    session_unset(); // Borra todas las variables de sesión
    session_destroy(); // Destruye la sesión
    header( "Location: ../View/InicioSesion/index1.html"); 
    exit();
    }

        

  
    public function singup(): bool
{
    $nameN = trim($_POST["nameN"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $cpassword = trim($_POST["cpassword"]);

    // Verifica contraseñas
    if ($password !== $cpassword) {
        echo "Las contraseñas no coinciden";
        return false;
    }

    // Manejo de la imagen
    $imagenNombre = null;

    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $imagenTmp = $_FILES["imagen"]["tmp_name"];
        $imagenNombre = basename($_FILES["imagen"]["name"]);
        $rutaDestino = "../uploads/" . $imagenNombre;

        // Asegura que el directorio exista
        if (!file_exists("../uploads")) {
            if (!mkdir("../uploads", 0777, true)) {
                echo "Error al crear el directorio para las imágenes.";
                return false;
            }
        }

        // Mueve la imagen al destino
        if (!move_uploaded_file($imagenTmp, $rutaDestino)) {
            echo "Error al subir la imagen.";
            return false;
        }
    }

    // Inserta en base de datos
    $query = "INSERT INTO usuarios (nameN, email, contrasena, imagen) VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . $this->conn->error;
        return false;
    }

    $stmt->bind_param("ssss", $nameN, $email, $password, $imagenNombre);

    if ($stmt->execute()) {
        $_SESSION["Singed"] = true;
        header("Location: ../View/InicioSesion/index1.html");
        return true;
    } else {
        $_SESSION["Singed"] = false;
        echo "Error al registrar: " . $stmt->error;
        return false;
    }
}


public function cuenta(): void
{
  
    if ($_SESSION["email"] == "administrador1234@gmail.com") {
        header("Location: ../Cuenta/cuentaAdmin.html");
    } else {
  
        $query = "SELECT imagen FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $_SESSION["email"]);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $_SESSION["imagen"] = $row["imagen"]; 
        }

        header("Location: ../Cuenta/cuenta.php");
    }

    exit();
}
}
?>
