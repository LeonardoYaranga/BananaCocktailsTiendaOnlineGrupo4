<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Pedidos Online | Banana's Cocktails</title>
  <link rel="stylesheet" type="text/css" href="./styles/indexStyle.css">
</head>

<?php

// Inicializar el arreglo de productos seleccionados
if (!isset($_SESSION['productos_seleccionados'])) {
  $_SESSION['productos_seleccionados'] = [];
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['producto'], $_POST['precio'])) {
    // Agregar el nuevo producto al arreglo
    $_SESSION['productos_seleccionados'][] = [
      'producto' => $_POST['producto'],
      'precio' => $_POST['precio']
    ];
  } elseif (isset($_POST['borrar_ultimo'])) {
    // Borrar el último producto si se envió el formulario para borrar
    array_pop($_SESSION['productos_seleccionados']);
  } elseif (isset($_POST['vaciar_lista'])) {
    // Vaciar toda la lista si se envió el formulario para vaciar
    $_SESSION['productos_seleccionados'] = [];
  }
}
?>

<body>



  <header>

    <table>

      <tr>
        <td style="width:6%">
          <img class="logoAnimado" src="./Images/Iconos/Logotipo.png" alt="Logotipo"
            style="width:220%; background-color: #ffff; border-radius: 80px;">
        </td>
        <td style="width:30%">
          <a href=" #" class="text">Inicio</a>
        </td>
        <td style="text-align: center; width:30%">
          <h1>Banana's Cocktails</h1>
          <p><em>¡Cócteles exclusivos a un clic de distancia!</em></p>
        </td>
        <td style="width:20%">

          <?php
          if (!empty($_GET["name"])) {
            $nameUser = $_GET["name"];
            echo '<h3>Hola ' . $nameUser . '</h3>';
          } else {
            echo '<a href="./Formularios/login.php" class="text">Iniciar sesión</a>';
          }
          ?>

        </td>
        <td id="carritoContainer" style="width:6%">
          <img class="carritoAnimado" src="./Images/Iconos/CarritoCompra.png" alt="Imagen de Carrito de Compras" style="width: 120%;"
            id="carritoImagen" onclick="openAside()">

        </td>
      </tr>
    </table>

  </header>
  <nav class="navul">
    <ul>
      <strong>
        <li class="navli"><a href="#vodka" class="nava">Vodka</a></li>
        <li class="navli"><a href="#ron" class="nava">Ron</a></li>
        <li class="navli"><a href="#tequila" class="nava">Tequila</a></li>
        <li class="navli"><a href="#whisky" class="nava">Whisky</a></li>
        <li class="navli"><a href="#gin" class="nava">Gin</a></li>
        <li class="navli"><a href="#vino" class="nava">Vino</a></li>
      </strong>
    </ul>
  </nav>


  <!-- <section class="catalogo" -->

    <!-- Mostrar productos seleccionados -->
    <aside id="popup">

      <button class="closebtn" onclick="closeAside()">Cerrar</button>
      <section class="aside-content">

        <article class="inputBox" id="productos-seleccionados">
          <label for="productos">Productos Seleccionados</label>
          <table border=2>
            <tr>
              <th>
                Producto
              </th>
              <th>
                Precio
              </th>
            </tr>
            <?php
            // Iterar sobre los productos seleccionados y mostrarlos en la tabla
            foreach ($_SESSION['productos_seleccionados'] as $producto) {
              echo "<tr>";
              echo "<td>{$producto['producto']}</td>";
              echo "<td>{$producto['precio']} $</td>";
              echo "</tr>";
            }
            ?>
          </table>

          
        </article>

        <!-- Formulario para finalizar la compra -->
        <form action="./Formularios/factura.php" method="post" target=" _blank">
          <?php
          // Agregar campos ocultos para todos los productos seleccionados
          foreach ($_SESSION['productos_seleccionados'] as $producto) {
            echo '<input type="hidden" name="productos[]" value="' . $producto['producto'] . '">';
            echo '<input type="hidden" name="precios[]" value="' . $producto['precio'] . '">';
          }
          ?>
          <input type="submit" value="Finalizar Compra">
        </form>

        <!-- Formulario para borrar el último producto -->
        <form action="index.php" method="post">
          <input type="submit" name="borrar_ultimo" value="Borrar Último Producto">
        </form>

        <!-- Formulario para vaciar la lista -->
        <form action="index.php" method="post">
          <input type="submit" name="vaciar_lista" value="Vaciar Lista">
        </form>
      </section>
    </aside>

    <?php
    $jsonData = file_get_contents('./Database/productos.json');

    $productos = json_decode($jsonData, true);

    if ($productos === null) {
      echo 'Error al decodificar el JSON';
    } else {
      $seccionActual = null;

      // Iterar sobre los productos
      foreach ($productos as $producto) {
        // Obtener los detalles del producto
        $nombre = $producto['nombre'];
        $descripcion = $producto['descripcion'];
        $section = $producto['section'];
        $precio = $producto['precio'];
        $imagen = $producto['imagen'];

        // Verificar si la sección actual es diferente a la sección del producto actual
        if ($seccionActual !== $section) {
          // Si es diferente, cerrar la sección anterior (si existe)
          if ($seccionActual !== null) {
            echo '</section>';
          }

            // Abrir una nueva sección con la clase correspondiente
            echo '<h2 id="' . strtolower($section) . '">' . $section . '</h2>';
         // echo ' <h2 id=' . strtolower($section) . ' Ref>' . $section . '</h2> ';
          echo '<section class="wrap" ' . $section . '">';

          // Actualizar la variable de sección actual
          $seccionActual = $section;
        }

        // Imprimir el contenido del producto
        echo '<article class="tarjeta-rest tarjetaAnimada" style="background: url(./Images/' . $section . '/' . $imagen . ') center; background-size: cover;">';
        echo '<section class="wrap-text_tarjeta-rest">';
        echo '<h3>' . $nombre . '</h3>';
        echo '<p>' . $descripcion . '</p>';
        echo '<section class="cta-wrap_tarjeta-rest">';
        echo '<article class="precio_tarjeta-rest">';
        echo '<span>' . $precio . '$</span>';
        echo '</article>';
        echo '<article class="cta_tarjeta-rest">';
        echo '<form method="post">';
        echo '<input type="hidden" name="producto" value="' . $nombre . '">';
        echo '<input type="hidden" name="precio" value="' . $precio . '">';
        echo '<input type="submit" value="Comprar">';
        echo '</form>';
        echo '</article>';
        echo '</section>';
        echo '</section>';
        echo '</article>';
      }

      // Cerrar la última sección (si existe)
      if ($seccionActual !== null) {
        echo '</section>';
      }
    }

    ?>
 <!-- </section> -->

  <footer>
    <img src="./Images/Iconos/instagram.png" alt="Instagram"
      onclick="window.open('https://www.instagram.com/', '_blank')">
    <img src="./Images/Iconos/facebook.png" alt="Facebook" onclick="window.open('https://www.facebook.com/', '_blank')">
    <img src="./Images/Iconos/tiktok.png" alt="TikTok" onclick="window.open('https://www.tiktok.com/', '_blank')">
    <p>&copy;2023 Banana's Cocktails</p>
  </footer>

  <script>
    function openAside() {
      var popup = document.getElementById("popup");
      var carritoImagen = document.getElementById("carritoImagen");

      popup.style.width = "30%";

      carritoImagen.style.display = "none";
    }

    function closeAside() {
      var popup = document.getElementById("popup");
      var carritoImagen = document.getElementById("carritoImagen");

      popup.style.width = "0%";

      carritoImagen.style.display = "block";
    }
  </script>

</body>

</html>