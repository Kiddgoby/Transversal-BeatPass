<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=beatpass", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $stmt = $pdo->query("SELECT * FROM eventos ORDER BY fecha DESC");
    $eventos = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eventos Registrados</title>
    <style>
        .evento {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 10px 0;
        }

        .evento img {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Eventos Registrados</h1>

    <?php if (count($eventos) > 0): ?>
        <?php foreach ($eventos as $evento): ?>
            <div class="evento">
                <h2><?= htmlspecialchars($evento["artista"]) ?></h2>
                <p><strong>Fecha:</strong> <?= htmlspecialchars($evento["fecha"]) ?></p>
                <p><strong>Lugar:</strong> <?= htmlspecialchars($evento["lugar"]) ?></p>
                <p><strong>Tipo:</strong> <?= htmlspecialchars($evento["tipo_evento"]) ?></p>
                <?php if ($evento["imagen"]): ?>
                    <img src="../../uploads_eventos/<?= htmlspecialchars($evento["imagen"]) ?>" alt="Imagen del evento">
                <?php endif; ?>
                <form action="../../Controller/ControladorEvento.php" method="POST">
                    <input type="hidden" name="id" value="<?= $evento["id"] ?>">
                    <button type="submit" name="eliminar_evento">Eliminar</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay eventos registrados.</p>
    <?php endif; ?>
</body>
</html>
