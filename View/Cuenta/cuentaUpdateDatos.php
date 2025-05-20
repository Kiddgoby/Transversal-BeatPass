<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventoController = new EventoController();

    if (isset($_POST["crear_evento"])) {
        $eventoController->crear();
        echo __LINE__;
    } elseif (isset($_POST["eliminar_evento"])) {
        $eventoController->eliminar($_POST["id"]);
        echo __LINE__;
    }
}

class EventoController {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=beatpass", "root", "", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Conexión fallida: " . $e->getMessage());
        }
    }

    public function crear(): bool {
        $fecha = $_POST["fecha"];
        $artista = $_POST["artista"];
        $lugar = $_POST["lugar"];
        $tipo_evento = $_POST["tipo_evento"];

        $imagenNombre = null;
        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
            $imagenTmp = $_FILES["imagen"]["tmp_name"];
            $imagenNombre = basename($_FILES["imagen"]["name"]);
            $rutaDestino = "../uploads_eventos/" . $imagenNombre;

            if (!file_exists("../uploads_eventos")) {
                mkdir("../uploads_eventos", 0777, true);
            }

            if (!move_uploaded_file($imagenTmp, $rutaDestino)) {
                echo "Error al subir la imagen.";
                return false;
            }
        }

        $query = "INSERT INTO eventos (fecha, artista, lugar, tipo_evento, imagen) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($query);

        try {
            if ($stmt->execute([$fecha, $artista, $lugar, $tipo_evento, $imagenNombre])) {
                header("Location: ../View/Eventos/listado_eventos.php");
                return true;
            }
        } catch (PDOException $e) {
            echo "Error al crear evento: " . $e->getMessage();
        }

        return false;
    }

    public function eliminar($id): void {
        $query = "DELETE FROM eventos WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);

        header("Location: ../View/Eventos/listado_eventos.php");
        exit();
    }
}
?>
