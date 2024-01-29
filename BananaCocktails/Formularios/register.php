<!DOCTYPE html>

<html>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/loginStyle.css">
  <meta charset="UTF-8">
  <title>Register</title>
  
</head>

<body>

  <section>
    <article class="contenedor">
      <article class="formulario">

        <form method="post">
          <?php
include('controlador.php');
          ?>
          <h2>Registrate</h2>
          <article class="inputContenedor">
            <i class="fas fa-user"></i>
            <input type="text" name="nombreRegister" id="nombreRegister" pattern="[A-Za-z]+" maxlength="100" required>
            <label for="nombreRegister">Nombre</label>
          </article>
          <article class="inputContenedor">
            <i class="fas fa-user"></i>
            <input type="text" name="apellido" id="apellido" pattern="[A-Za-z]+" maxlength="100" required>
            <label for="apellido">Apellido</label>
          </article>
          <article class="inputContenedor">
            <input type="date" name="fechaNacimiento" id="fechaNacimiento" required>
            <label for="fechaNacimiento">Fecha de nacimiento</label>
          </article>
          <article class="inputContenedor">
            <i class="fas fa-envelope"></i>
            <input type="email" name="emailRegister" id="emailRegister" required>
            <label for="usuario">Email</label>
          </article>
          <article class="inputContenedor">
            <i class="fas fa-lock"></i>
            <input type="password" name="passwordRegister" id="password" required>
            <label for="password">Contraseña</label>
          </article>

          <article class="registrar">
            <input name="buttonRegister" id="buttonRegister" type="submit" value="Acceder">
          </article>
      </article>

      </form>



    </article>




    </article>
  </section>

</body>

</html>