<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
</head>
<body>
    <header>
        <h1>Beat Pass</h1>
    </header>

    <main>
        <div class="container">
            <div class="left-section">
                <h1>Cuenta</h1>
            </div>

            <div class="right-section">
                <?php
                if (isset($_SESSION['usuario'])) {
                    echo "<p>Bienvenido, " . $_SESSION['usuario'] . "</p>";
                    echo '<a href="cerrar_sesion.php"><button>Cerrar sesión</button></a>';
                } else {
                    echo '<a href="index1.html"><button>Iniciar sesión</button></a>';
                    echo ' ';
                    echo '<a href="SRegistro.html"><button>Registrarme</button></a>';
                }
                ?>
            </div>
        </div>
    </main>
</body>
</html>
