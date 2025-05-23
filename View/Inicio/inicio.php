<!DOCTYPE html>
<html lang="en">
<head>
    <!--link para usa funciones de bootsrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beat Pass</title>
    <link rel="icon" type="image/png" href="../logoBilleteArnau.png">

    <script src="inicio.js" defer></script>


    <link rel="stylesheet" href="../headerComun.css">
    <link rel="stylesheet" href="StyleInicio.css">
    
    <!-- Fuentes de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat&family=Oswald&display=swap" rel="stylesheet">
</head>

<?php session_start(); ?>
<?php $email = $_SESSION["email"] ?? null; ?>
<script>
    const emailFromPHP = <?php echo json_encode($email); ?>;
    if (emailFromPHP) {
        localStorage.setItem("email", emailFromPHP);
    }
</script>

<body>
    <?php include '../header.php'; ?>

    <article class="portada">
        <h2 class="titulo">EL PRIMER CONCIERTO ES UNICO</h2>
        <img src="../../Imagenes_A_Usar/rachel-coyne-U7HLzMO4SIY-unsplash.jpg" alt="">
    </article>

    <div class="top">
        <h2 class="titulo">TOP VENTAS</h2>
    </div>

<!-- Saga de 3 cartas con animaciones -5px con hober -->
    <article class="card-container">
    <div class="card">
        <img src="https://i.pinimg.com/736x/53/0a/eb/530aeb88fd401f98741e8f011573d192.jpg" alt="Quevedo">
        <div class="card-body">
            <h5 class="card-title">Quevedo</h5>
            <p class="card-text">Prepárate para disfrutar el mejor concierto de tu vida.</p>
            <a href="../pagina_compra/info_compra.html" class="botonDefecto">Saber más</a>
        </div>
    </div>
<!------------------------------------------------------>
    <div class="card">
        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/YUNGBEEF.jpg" alt="Don Debil">
        <div class="card-body">
            <h5 class="card-title">YUNGBEEF</h5>
            <p class="card-text">El nuevo álbum en vivo. ¡No te lo puedes perder!</p>
            <a href="../pagina_compra/info_compra.html" class="botonDefecto">Saber más</a>
         </div>
    </div>
<!------------------------------------------------------>
    <div class="card">
        <img src="https://www.totalisimo.com/wp-content/uploads/2018/08/yandel-portada.jpg" alt="Yandel">
        <div class="card-body">
            <h5 class="card-title">Yandel</h5>
            <p class="card-text">Reggaetón puro en una noche explosiva de música y luces.</p>
            <a href="#" class="botonDefecto" >Saber más</a>
        </div>
    </div>
</article>

<!-- fin saga -->

    <section class="mas-buscado">
        <h2 class="titulo">LO MÁS BUSCADO</h2>
        <div class="grid-contenedor">
            <a href="#">
                <div class="grid-item">
                    <div class="imagen-contenedor">
                        <img src="../../Imagenes_A_Usar/badbunny.jpg" alt="BAD BUNNY">
                    </div>
                    <div class="boton">
                        BAD BUNNY
                    </div>
                </div>
            </a>

            <a href="#">
                <div class="grid-item">
                    <div class="imagen-contenedor">
                        <img src="../../Imagenes_A_Usar/drake.jpg" alt="Drake">
                    </div>
                    <div class="boton">
                        DRAKE
                    </div>
                </div>
            </a>

            <a href="#">
                <div class="grid-item">
                    <div class="imagen-contenedor">
                        <img src="../../Imagenes_A_Usar/kanyewes.jpg" alt="Kanye West">
                    </div>
                    <div class="boton">
                        KANYE WEST
                    </div>
                </div>
            </a>

            <a href="#">
                <div class="grid-item">
                    <div class="imagen-contenedor">
                        <img src="../../Imagenes_A_Usar/shakira.jpg" alt="OLIVIA RODRIGO">
                    </div>
                    <div class="boton">
                        SHAKIRA
                    </div>
                </div>
            </a>

            <a href="">
                <div class="grid-item">
                    <div class="imagen-contenedor">
                        <img src="../../Imagenes_A_Usar/delaossa.jpg" alt="DELAOSSA">
                    </div>
                    <div class="boton">
                        DELAOSSA
                    </div>
                </div>
            </a>
        </div>
    </section>

    <section class="container">
        <h2>sisisisisisisisisisisisisisisisisi</h2>
    </section>

    <br>
    <footer>
        <p>&copy; 2025 Beat Pass. Todos los derechos reservados.</p>
    </footer> 
</body>
</html>