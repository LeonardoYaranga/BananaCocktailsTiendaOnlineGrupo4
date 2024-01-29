<?php
session_start();

// Verificar si se ha enviado un formulario de compra
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto'], $_POST['precio'])) {
    $producto = $_POST['producto'];
    $precio = floatval($_POST['precio']);

    // Inicializar la sesión del carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Agregar el producto al carrito
    $_SESSION['carrito'][] = ['producto' => $producto, 'precio' => $precio];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Facturación</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../styles/facturaStyle.css">

</head>

<body>

    <header>
        <h1> Facturación </h1>
    </header>

    <section class="container">

        <p>Para realizar una compra, por favor llena el siguiente formulario con todos tus datos y nos contactaremos
            con usted a la brevedad posible para confirmarla.
        </p>

        <form action="../Formularios/recuperarFactura.php" method="post" target="_blank">

            <article class="inputBox">
                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" placeholder="Ingresa tu nombre" pattern="[A-Za-z]+" required />
            </article>

            <article class="inputBox">
                <label for="apellido">Apellido</label>
                <input id="apellido" name="apellido" placeholder="Ingresa tu apellido" pattern="[A-Za-z]+" required />
            </article>

            <article class="inputBox">
                <label for="cedula">Numero de cedula</label>
                <input id="cedula" name="cedula" placeholder="Ingresa tu número de cedula" minlength="10"
                    pattern="[0-9]{10}" required />
            </article>

            <article class="inputBox">
                <label for="celular">Celular</label>
                <input type="tel" name="celular" id="celular" placeholder="Ingresa tu número de celular" minlength="10"
                    pattern="[0-9]{10}" required />
            </article>

            <article class="inputBox">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Ingresa tu email" required />
            </article>

            <article class="inputBox">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" required />
            </article>


            <article class="inputBox">
                <label for="productos">Productos</label>
                <table border=2 class="table-productos">
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                    </tr>
                    <?php
                    // Mostrar productos seleccionados
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productos'], $_POST['precios'])) {
                        foreach ($_POST['productos'] as $index => $producto) {
                            echo "<tr>";
                            echo "<td>{$producto}</td>";
                            echo "<td>{$_POST['precios'][$index]} $</td>";
                            // Campos ocultos para cada producto y precio con input para que se recuperar datos
                            echo "<input type='hidden' name='productos[]' value='{$producto}'>";
                            echo "<input type='hidden' name='precios[]' value='{$_POST['precios'][$index]}'>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </article>

            <article class="inputBox">
                <label for="direccion"> Dirección </label>
                <br>
                <textarea cols="35" rows="7" id="direccion" name="direccion" pattern="[A-Za-z0-9\s\-\.,]+"></textarea>
            </article>


            <article class="button">
                <button type="submit" value="compra"> Realizar Compra </button>
            </article>

        </form>

    </section>

    <footer>
        <img src="../Images/Iconos/instagram.png" alt="Instagram">
        <img src="../Images/Iconos/facebook.png" alt="Facebook">
        <img src="../Images/Iconos/tiktok.png" alt="TikTok">
        <p>&copy;2023 Banana's Cocktails</p>
    </footer>


</body>

</html>