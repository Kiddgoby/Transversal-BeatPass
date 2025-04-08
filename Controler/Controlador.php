<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gmail = $_POST["gmail"];
    $password = $_POST["password"];

    $user = new UserController($gmail, $password);

    if (isset($_POST["Login"])) {
        if ($user->login($gmail, $password)) {
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
    private $gmail;
    private $password;

    public function __construct($gmail, $password)
    {
        $this->gmail = $gmail;
        $this->password = $password;

        // Conexión a la base de datos
        $this->conn = new mysqli("localhost", "root", "BeatPass1234", "beatpass");

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function login(): bool
    {
        $stmt = $this->conn->prepare("SELECT contrasena FROM usuarios WHERE gmail = ?");
        $stmt->bind_param("s", $this->gmail);
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
    

    // private function logout(): void
    // {
    //     echo "Sesión cerrada.";
    // }

    public function register(): void
    {
        echo "Usuario registrado.";
    }
}
?>
