<?php
session_start();
require_once "../../Controler/Controlador.php";

$email = $_SESSION["email"] ?? null;

if (!$email) {
    header("Location: ../InicioSesion/index1.html");
    exit;
}

$userController = new UserController();

// Solo procesar si el método es POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nameN = trim($_POST["nameN"]);
    $password = trim($_POST["password"]) ?: null;
    $imagen = $_FILES["imagen"] ?? null;

    if ($userController->update($email, $nameN, $password, $imagen)) {
        // Actualizar imagen en sesión si se subió
        if ($imagen && isset($imagen["name"]) && $imagen["name"] !== "") {
            $_SESSION["imagen"] = $imagen["name"];
        }
        header("Location: ../Cuenta/cuenta.php");
        exit;
    } else {
        $error = "Error al actualizar los datos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beat Pass - Cuenta</title>
    <link rel="icon" type="image/png" href="../logoBilleteArnau.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="StyleC.css">
    <link rel="stylesheet" href="../headerComun.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@400;600&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="formulario">
        <h2>Actualizar tus datos</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['imagen'])): ?>
            <p><strong>Imagen actual:</strong></p>
            <img src="../uploads/<?= htmlspecialchars($_SESSION['imagen']) ?>" width="100" height="100" alt="Imagen actual">
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="nameN" value=" <?php echo$_SESSION['nameN'] ?? ''; ?>" required>

            <input type="email" name="email" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" readonly>

            <input type="password" name="password" placeholder="Nueva contraseña">

            <input type="file" name="imagen">

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
