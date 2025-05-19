<!DOCTYPE html>
<html lang="es">

<head>
    <!-- METADATOS Y ENLACES IMPORTANTES -->
    
    <!-- Enlace a Bootstrap para usar su sistema de estilos rápidos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Configuración de caracteres y vista para móviles -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Título que se muestra en la pestaña del navegador -->
    <title>Beat Pass - Inicio de Sesión</title>

    <!-- Ícono pequeño que aparece en la pestaña del navegador -->
    <link rel="icon" type="image/png" href="../logoBilleteArnau.png">

    <!-- Enlace a nuestro archivo de estilos personalizados -->
    <link rel="stylesheet" href="../headerComun.css">
    <link rel="stylesheet" href="StyleC.css">

    <!-- Enlace a las fuentes externas de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@400;600&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <!-- CABECERA de la página -->
    <header>
        <h1 class="titulo">Beat Pass</h1>
    </header>

    <main class="pagina">
        <article class="perfil">
            <div class="infoPerfil">
                <div class="principio">
                    <h2 class="titulo"><?= htmlspecialchars($nameN) ?></h2>

                    <?php if (!empty($imagen)): ?>
                        <img src="../../uploads/<?= htmlspecialchars($imagen) ?>" alt="Imagen de perfil" id="imagenPerfil" style="width: 150px; height: 150px; border-radius: 50%;">

                    <?php else: ?>
                        <p>No hay imagen de perfil</p>
                    <?php endif; ?>
                </div>

                <div class="datos">
                    <p class="titulo">Próximos conciertos:</p>
                    <p class="info">Aún no hay conciertos. ¡Explora nuestra web y encuentra las mejores ofertas!</p>
                </div>
            </div>
            
            <div class="posibilidades">
                <a href="../Inicio/inicio.html">
                    <button type="submit" name="misEventos" id="misEventos" class="button">Mis Eventos</button>
                </a>
            
                <a href="../Cuenta/cuentaUpdateDatos.php">
                    <button type="submit" name="Modificar" id="Modificar" class="button">Modificar Perfil</button>
                </a>
                <form action="../../Controler/Controlador.php" method="POST">
                    <button type="submit" name="logout" id="logout" class="button">Cerrar Sesión</button>
                </form>
            </div>

        </article>
    </main>

    <form action="../../Controler/Controlador.php" method="POST">
                    <button type="submit" name="logout" id="logout" class="button">Cerrar Sesion</button>
    </form>
    <!-- PIE DE PÁGINA -->
    <br>
    <footer>
        <p>&copy; 2025 Beat Pass. Todos los derechos reservados.</p>
    </footer> 
</body>

</html>
