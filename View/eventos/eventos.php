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

<<<<<<< HEAD
<!DOCTYPE html>
<html lang="es">
<head>
    <!--link para usa funciones de bootsrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

=======





<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

>>>>>>> d0b5e8ae955a8ff57a9a6a1d8d58002f24fb8ff0
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beat Pass</title>
    <link rel="icon" type="image/png" href="../logoBilleteArnau.png">
<<<<<<< HEAD

    <link rel="stylesheet" href="../headerComun.css">
    <link rel="stylesheet" href="StyleE.css">
    
    <!-- Fuentes de Google Fonts -->
=======
    
    <link rel="stylesheet" href="StyleE.css">
    <link rel="stylesheet" href="../headerComun.css">

    <!-- Google Fonts -->
>>>>>>> d0b5e8ae955a8ff57a9a6a1d8d58002f24fb8ff0
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat&family=Oswald&display=swap" rel="stylesheet">
</head>


<body>
<<<<<<< HEAD
    <?php include '../header.php'; ?>
    
    <h1>Eventos Registrados</h1>

=======
    <header>
        <div class="left">
            <div class="izquierda">
                <a href="../Inicio/inicio.html">
                    <img src="../logoBilleteArnau.png" alt="">
                </a>    
            </div>
            <h1 class="titulo">Beat Pass</h1>
        </div>
        <div class="rigth">
            <div class="idioma-selector">
                <select onchange="window.location.href=this.value">
                    <option value="../Inicio/inicio.html" selected>Español</option>
                    <option value="../Inicio/inicio_cat.html">Català</option>
                    <option value="../Inicio/inicio_en.html">English</option>
                </select>
            </div>              
            <!-- Posivilidades dentro de la web -->
            <a href="../eventos/eventos.html">Eventos</a>
            <a href="../lugares/Lugares.html">Lugares</a>
            <a href="../Cuenta/cuenta.php">Cuenta</a>  
            <a href="../Inicio/inicio.html">Inicio</a>      
        </div>
    </header>
>>>>>>> d0b5e8ae955a8ff57a9a6a1d8d58002f24fb8ff0
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

            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay eventos registrados.</p>
    <?php endif; ?>

    <footer>
        <p>&copy; 2025 Beat Pass. Todos los derechos reservados.</p>
    </footer> 
</body>
</html>
