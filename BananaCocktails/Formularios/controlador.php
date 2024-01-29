 <?php
 session_start();
 ?>

<style>

    .alertDanger{
        background-color: #f44336;
        color: white;
        padding: 20px;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        display: inline-block; 
    }
    .alertSuccess{
        background-color: #4CAF50;
        color: white;
        padding: 20px;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }
    </style>

<?php


if(empty($_SESSION["nombre"])){
    $_SESSION["nombre"] = "invitado";
    $_SESSION["email"] = "invitado@hotmail.com";
    $_SESSION["password"]= "invitado123";
}


if(!empty($_POST["emailRegister"])){
    $_SESSION["nombre"] = $_POST["nombreRegister"];
    $_SESSION["email"] = $_POST["emailRegister"];
$_SESSION["password"]= $_POST["passwordRegister"];
header("Location: login.php");
exit();
}

if (!empty($_POST["buttonSubmit"])) {
    if (empty($_POST["email"]) || empty($_POST["password"])) {
        echo '<article class="alertDanger">Los campos son obligatorios</article>';
    } else {
        // Campos presentes, ahora verificar el usuario y la contraseña
        $email_ingresado = $_POST["email"];
        $contrasena_ingresada = $_POST["password"];

        if ($email_ingresado ==  $_SESSION["email"] && $contrasena_ingresada == $_SESSION["password"]) {
            echo '<article class="alertSuccess">Inicio de sesión exitoso</article>';
            header("Location: ../index.php?name=".$_SESSION["nombre"]);
            exit();
        } else {
            echo '<article class="alertDanger">Usuario o contraseña incorrectos</article>';
        }
    }
}
?>
