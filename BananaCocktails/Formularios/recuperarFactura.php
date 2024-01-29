<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <link rel="stylesheet" type="text/css" href="../styles/recuperarFactStyle.css">
</head>

<body>

    <section class="container">
        <h2>Factura</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <td>
                    <?php echo $_POST["nombre"]; ?>
                </td>
            </tr>
            <tr>
                <th>Apellido</th>
                <td>
                    <?php echo $_POST["apellido"]; ?>
                </td>
            </tr>
            <tr>
                <th>Cedula</th>
                <td>
                    <?php echo $_POST["cedula"]; ?>
                </td>
            </tr>
            <tr>
                <th>Email</th>
                <td>
                    <?php echo $_POST["email"]; ?>
                </td>
            </tr>
            <tr>
                <th>Fecha</th>
                <td>
                    <?php echo $_POST["fecha"]; ?>
                </td>
            </tr>
            <tr>
                <th>Dirección</th>
                <td>
                    <?php echo $_POST["direccion"]; ?>
                </td>
            </tr>
        </table>

        <h3>Productos</h3>
        <table border=2>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
            </tr>
            <?php
            // Inicializar el total
            $total = 0;

            // Mostrar productos seleccionados
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productos'], $_POST['precios'])) {
                foreach ($_POST['productos'] as $index => $producto) {
                    echo "<tr>";
                    echo "<td>{$producto}</td>";
                    echo "<td>{$_POST['precios'][$index]} $</td>";

                    // Sumar al total
                    $total += $_POST['precios'][$index];

                    echo "</tr>";
                }
            }

            // Mostrar la fila del total después del bucle
            echo "<tr>";
            $color = 'lightgray';
            echo "<td style='background-color: $color;'>Total</td>";
            echo "<td style='background-color: $color;'>{$total} $</td>";
            echo "</tr>";
            ?>
        </table>
    </section>

</body>

</html>