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
    }

    public function login($gmail, $password): bool
    {
        $userGmail = "abcd@gmail.com";
        $userPassword = "1234";

        return $gmail === $userGmail && $password === $userPassword;
    }

    public function get_gmail(): mixed
    {
        return $this->gmail;
    }

    // private function logout(): void
    // {
    //     echo "Sesión cerrada.";
    // }
        
    private function logout(): void
    {
    session_start();
    session_unset(); // Borra todas las variables de sesión
    session_destroy(); // Destruye la sesión
    echo "Sesión cerrada.";
    header("Location: inicio.html"); 
    exit();
    }

        

    public function register(): void
    {
        echo "Usuario registrado.";
    }
}
?>
