<?php
//session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Pedidos Online | Banana's Cocktails</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="./styles/indexStyle.css">
  <link rel="stylesheet" type="text/css" href="./styles/paraCarrito.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="./scripts/carrito.js" async></script>
  <script src="./scripts/nav.js" async></script>
</head>

<body>

  <header>

    <table>

      <tr>
        <td style="width:5%">
          <img class="logoAnimado" src="./Images/Iconos/Logotipo.png" alt="Logotipo"
            style="width:250%; background-color: #ffff; border-radius: 80px;">
        </td>
        <td style="width:29%">
          <a href=" #" class="text">Inicio</a>
        </td>
        <td style="text-align: center; width:30%">
          <h1>Banana's Cocktails</h1>
          <p><em>¡Cócteles exclusivos a un clic de distancia!</em></p>
        </td>
        <td style=" width:20%">

          <?php
          if (!empty($_GET["name"])) {
            $nameUser = $_GET["name"];
            echo '<h3 class="helloUser">Hola ' . $nameUser . '</h3>';
          } else {
            echo '<a href="./Formularios/login.php" class="text">Iniciar sesión</a>';
          }
          ?>

        </td>
        <td id="carritoContainer" style="width:6%">
          <img class="carritoAnimado" src="./Images/Iconos/CarritoCompra.png" alt="Imagen de Carrito de Compras"
            style="width: 120%;" id="carritoImagen" onclick="openAside()">

        </td>
      </tr>
    </table>

  </header>
  <nav class="navul">
    <ul>
      <strong>
        <li class="navli"><a href="#whisky" class="nava">Whisky</a></li>
        <li class="navli"><a href="#ron" class="nava">Ron</a></li>
        <li class="navli"><a href="#tequila" class="nava">Tequila</a></li>
        <li class="navli"><a href="#vodka" class="nava">Vodka</a></li>
        <li class="navli"><a href="#gin" class="nava">Gin</a></li>
        <li class="navli"><a href="#vino" class="nava">Vino</a></li>
      </strong>
    </ul>
  </nav>

  <!-- Mostrar productos seleccionados -->
  <aside id="popup">

    <button class="closebtn" onclick="closeAside()">Cerrar</button>
    <div class="aside-content">
      <!-- Carrito de Compras -->
      <div class="carrito" id="carrito">
        <div class="header-carrito">
          <h3>Tu Carrito</h3>
        </div>

        <div class="carrito-items">
          <!--Aquí se mostrarán los productos seleccionados-->
        </div>
        <div class="carrito-total">
          <div class="fila">
            <strong>Tu Total</strong>
            <span class="carrito-precio-total">
              $120.000,00
            </span>
          </div>
          <button class="btn-pagar">Pagar <i class="fa-solid fa-bag-shopping"></i> </button>
        </div>
      </div>
        </div>

  </aside>


  <section class="catalogo">

    <!-- Cargar productos a mostrar -->
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
          echo '<h2 id="' . strtolower($section) . '" class="contenedor-items"' . '>' . $section . '</h2>';
          echo '<section class="wrap ' . $section . '">';

          // Actualizar la variable de sección actual
          $seccionActual = $section;
        }
        ?>

<!--Imprimir el contenido del producto-->
<article class="tarjeta tarjetaAnimada item">
          <section class="face front">
            <img src="./Images/<?php echo $section; ?>/<?php echo $imagen; ?>" alt="<?php echo $nombre; ?>"
              class="img-item">

            <section class="wrap-text_tarjeta">
              <article class="precio_tarjeta">
                <span class="precio-item">
                  <?php echo $precio; ?>$
                </span>
              </article>
              <span class="titulo-item">
                <?php echo $nombre; ?>
              </span>

            </section>

          </section>
          <section class="face back">
            <section class="wrap-text_tarjeta">
              <span class="titulo-item">
                <?php echo $nombre; ?>
              </span>
              <p>
                <?php echo $descripcion; ?>
              </p>
              <section class="cta-wrap_tarjeta">
                <article class="precio_tarjeta">
                  <span class="precio-item">
                    <?php echo $precio; ?>$
                  </span>
                </article>
                <article class="cta_tarjeta">
                  <button class="boton-item" onclick="openAside()">Agregar al Carrito</button>
                </article>
              </section>
            </section>
          </section>
        </article>

        <?php
      }

      // Cerrar la última sección (si existe)
      if ($seccionActual !== null) {
        echo '</section>';
      }
    }

    ?>

    <footer>
      <img src="./Images/Iconos/instagram.png" alt="Instagram"
        onclick="window.open('https://www.instagram.com/', '_blank')">
      <img src="./Images/Iconos/facebook.png" alt="Facebook"
        onclick="window.open('https://www.facebook.com/', '_blank')">
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