<?php

require_once "../../Controler/Controlador.php";  // Asegúrate de que la ruta sea correcta

// Iniciar sesión y obtener el email del usuario
$email = $_SESSION["email"] ?? null;
$imagen = null;

if ($email) {
    // Instanciar el controlador de usuario
    $userController = new UserController();  // Asegúrate de que la clase se instancia correctamente

    // Consultar la imagen del usuario
    $query = "SELECT imagen FROM usuarios WHERE email = ?";
    $stmt = $userController->getConnection()->prepare($query); // Accedes a la conexión usando el método getConnection
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Obtener la imagen si existe
    if ($row = $result->fetch_assoc()) {
        $imagen = $row["imagen"];
    }
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
</head>

<body>
    <header>
        <h1 class="titulo">Beat Pass</h1>
    </header>

    <main class="pagina">
        <article class="perfil">
            <div class="principio">
                <h2 class="titulo"><?= htmlspecialchars($nombre) ?></h2>
                <img src="../uploads/<?= htmlspecialchars($imagen) ?>" alt="Imagen de perfil" id="imagenPerfil">

                <!-- Formulario para subir nueva imagen -->
                <form action="cambiar_imagen.php" method="POST" enctype="multipart/form-data" style="text-align: center;">
                    <input type="file" name="nueva_imagen" id="nuevaImagen" accept="image/*" style="display: none;" required>
                    <label for="nuevaImagen" class="button"><h3>Seleccionar imagen</h3></label>
                    <button type="submit" class="button" style="margin-top: 10px;"><h3>Subir imagen</h3></button>
                </form>
            </div>

            <div class="datos">
                <p class="titulo">Próximos conciertos:</p>
                <p class="info">Aún no hay conciertos. ¡Explora nuestra web y encuentra las mejores ofertas!</p>
            </div>
        </article>

        <article class="derecha">
            <img src="../../Imagenes_A_Usar/pexels-photo-976866..png" alt="Decoración Beat Pass" class="decorativa">
        </article>
    </main>

    <form action="../../Controler/Controlador.php" method="POST">
        <button type="submit" name="logout" id="logout" class="button">Cerrar Sesión</button>
    </form>
    
    <footer>
        <p>&copy; 2025 Beat Pass. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
