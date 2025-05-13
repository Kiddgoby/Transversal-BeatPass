<?php
session_start();
require_once "../../Controler/Controlador.php";

$email = $_SESSION["email"] ?? null;

if (!$email) {
    header("Location: ../InicioSesion/index1.html");
    exit;
}

$userController = new UserController();

$nameN = trim($_POST["nameN"]);
$password = trim($_POST["password"]) ?: null;
$imagen = $_FILES["imagen"] ?? null;

if ($userController->update($email, $nameN, $password, $imagen)) {
    $_SESSION["imagen"] = $imagen["name"] ?? $_SESSION["imagen"];
    header("Location: ../Cuenta/cuenta.php");
} else {
    echo "Error al actualizar los datos.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beat Pass - Cuenta</title>
    <link rel="icon" type="image/png" href="../logoBilleteArnau.png">
    <link rel="stylesheet" href="StyleC.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@400;600&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../headerComun.css">
</head>
<body>
    <div class="formulario">
        <h2>Actualizar tus datos</h2>

        <?php if ($imagen): ?>
            <p><strong>Imagen actual:</strong></p>
            <img src="../../uploads/<?= htmlspecialchars($imagen) ?>" alt="Imagen de perfil">
        <?php endif; ?>

        <<form method="POST" action="../../Controller/UserController.php" enctype="multipart/form-data">
            <input type="text" name="nameN" value="<?php echo $_SESSION['nameN'] ?? ''; ?>" required>

            <input type="email" name="email" value="<?php echo $_SESSION['email'] ?? ''; ?>" readonly>

            <input type="password" name="password" placeholder="Nueva contraseña">

            <input type="file" name="imagen">
            <?php if (!empty($_SESSION['imagen'])): ?>
                <img src="../uploads/<?php echo $_SESSION['imagen']; ?>" width="100" height="100" alt="Imagen actual">
            <?php endif; ?>

            <button type="submit" name="update">Actualizar</button>
    </form>
    </div>
</body>
</html>