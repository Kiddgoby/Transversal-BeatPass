<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UserController = new UserController();

    if (isset($_POST["Login"])) {
        $UserController->login();
    } elseif (isset($_POST["Singup"])) {
        $UserController->singup();
    } elseif (isset($_POST["logout"])) {
        $UserController->logout();
    } elseif (isset($_POST["cuenta"])) {
        $UserController->cuenta();
    }
}

class UserController {
    private $conn;

    public function __construct() {
        $dsn = "mysql:host=localhost;dbname=beatpass;charset=utf8mb4";
        $user = "root";
        $pass = "";

        try {
            $this->conn = new PDO($dsn, $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Conexión fallida: " . $e->getMessage());
        }
    }

    public function login(): bool {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        $query = "SELECT email, contrasena FROM usuarios WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $row["contrasena"])) {
                $_SESSION["logged"] = true;
                $_SESSION["email"] = $row["email"];

                header("Location: ../View/Inicio/inicio.html");
                return true;
            }
        }

        $_SESSION["logged"] = false;
        $_SESSION["Login_Error"] = "Email o contraseña incorrectos";
        header("Location: ../View/InicioSesion/index1.html");
        return false;
    }

    public function logout(): void {
        session_unset();
        session_destroy();
        header("Location: ../View/InicioSesion/index1.html");
        exit();
    }

    public function singup(): bool {
        $nameN = trim($_POST["nameN"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $cpassword = trim($_POST["cpassword"]);

        if ($password !== $cpassword) {
            echo "Las contraseñas no coinciden";
            return false;
        }

        $imagenNombre = null;

        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
            $imagenTmp = $_FILES["imagen"]["tmp_name"];
            $imagenNombre = basename($_FILES["imagen"]["name"]);
            $rutaDestino = "../uploads/" . $imagenNombre;

            if (!file_exists("../uploads")) {
                if (!mkdir("../uploads", 0777, true)) {
                    echo "Error al crear el directorio para las imágenes.";
                    return false;
                }
            }

            if (!move_uploaded_file($imagenTmp, $rutaDestino)) {
                echo "Error al subir la imagen.";
                return false;
            }
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuarios (nameN, email, contrasena, imagen) VALUES (:nameN, :email, :password, :imagen)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nameN', $nameN);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':imagen', $imagenNombre);

        if ($stmt->execute()) {
            $_SESSION["Singed"] = true;
            header("Location: ../View/InicioSesion/index1.html");
            return true;
        } else {
            $_SESSION["Singed"] = false;
            echo "Error al registrar";
            return false;
        }
    }

    public function cuenta(): void {
        if ($_SESSION["email"] == "administrador1234@gmail.com") {
            header("Location: ../Cuenta/cuentaAdmin.html");
        } else {
            $query = "SELECT imagen FROM usuarios WHERE email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $_SESSION["email"]);
            $stmt->execute();

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION["imagen"] = $row["imagen"];
            }

            header("Location: ../Cuenta/cuenta.php");
        }

        exit();
    }
}
?>
