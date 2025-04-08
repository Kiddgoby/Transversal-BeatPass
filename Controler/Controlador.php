<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $user = new UserController($email, $password);

    if (isset($_POST["Login"])) {
        if ($user->login($email, $password)) {
            header("Location: ../View/Inicio/inicio.html");
            exit;
        } else {
            echo "<p>Correo o contraseña incorrectos.</p>";
        }
    }

    // if (isset($_POST["Logout"])) {
    //     echo "<p>Logout Button is clicked.</p>";
    //     $user->logout();
    // }

    if (isset($_POST["Register"])) {
        echo "<p>Register Button is clicked.</p>";
        $user->register();
    }
}

class UserController
{
    private $conn;
    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;

        // Conexión a la base de datos
        $this->conn = new mysqli("localhost", "root", "", "beatpass");

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function login(): bool
    {
        $stmt = $this->conn->prepare("SELECT contrasena FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hash);
            $stmt->fetch();

            return password_verify($this->password, $hash);
        } else {
            return false;
        }

    }
    


    private function logout(): void
    {
    session_unset(); // Borra todas las variables de sesión
    session_destroy(); // Destruye la sesión
    echo "Sesión cerrada.";
    header("Location: inicio.html"); 
    exit();
    }

        

    public function register(): void
    {
        $hash = password_hash($this->password, PASSWORD_DEFAULT);

        // Comprobar si ya existe
        $check = $this->conn->prepare("SELECT id FROM usuarios WHERE gmail = ?");
        $check->bind_param("s", $this->email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            echo "<p>⚠️ Este correo ya está registrado.</p>";
            return;
        }

        $stmt = $this->conn->prepare("INSERT INTO usuarios (gmail, contrasena) VALUES (?, ?)");
        $stmt->bind_param("ss", $this->email, $hash);

        if ($stmt->execute()) {
            echo "<p>✅ Usuario registrado correctamente.</p>";
        } else {
            echo "<p>❌ Error al registrar: " . $stmt->error . "</p>";
        }

  
    }


}

?>
