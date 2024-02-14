
function validarSoloLetras(event) {
    var input = event.target;

    if (event.keyCode === 8 || event.keyCode === 32) {
        return;
    }

    if (input.type === "text" && !/^[a-zA-Z ]+$/.test(event.key)) {
        event.preventDefault();
    }
}


function validarSoloNumeros(event) {
    var input = event.target;

    if (input.type !== "number" && !/^\d$/.test(event.key)) {
        event.preventDefault();
    }
}

function validarCedula(cedula) {
    if (/^\d{10}$/.test(cedula)) {
        var total = 0;

        var digitos = cedula.substring(0, 9);

        for (var i = 0; i < digitos.length; i++) {
            var digito = parseInt(digitos[i]);
            digito = (i % 2 === 0) ? digito * 2 : digito;

            if (digito > 9) {
                digito = digito - 9;
            }

            total += digito;
        }

        var verificadorEsperado = (Math.ceil(total / 10) * 10) - total;

        var ultimoDigito = parseInt(cedula[9]);

        return verificadorEsperado === ultimoDigito;
    }

    return false;
}
function validarCedulaInput(inputCedula) {
    var mensajeError = document.getElementById('mensajeError');
    var botonEnviar = document.getElementById('botonEnviar');

    // Obtener el valor actual de la cédula
    var cedula = inputCedula.value;

    // Validar la cédula
    var esCedulaValida = validarCedula(cedula);

    // Establecer el mensaje de error y la validez del campo según la validez de la cédula
    if (esCedulaValida) {
        mensajeError.innerText = '';
        inputCedula.setCustomValidity('');
    } else {
        mensajeError.innerText = 'Cédula no válida';
        inputCedula.setCustomValidity('Cédula no válida');
    }

}

function validarCampo(inputCampo) {
    var mensajeError = obtenerMensajeError(inputCampo);

    // Establecer el mensaje de error y la validez del campo según la lógica de validación
    if (mensajeError) {
        inputCampo.setCustomValidity(mensajeError);
    } else {
        inputCampo.setCustomValidity('');
    }
}

function obtenerMensajeError(inputCampo) {
    var valorCampo = inputCampo.value;
    // Devuelve un mensaje de error si el valor no es válido, de lo contrario, devuelve ''
    switch (inputCampo.name) {
        case 'nombre':
            return validarNombre(valorCampo);
        case 'apellido':
            return validarApellido(valorCampo);
        case 'email':
            return validarEmail(valorCampo);
        case 'celular':
            return validarCelular(valorCampo);
        case 'password':
            return validatePassword(valorCampo);
        default:
            return '';
    }
}

function validarNombre(nombre) {
    return nombre.length < 3 ? 'Nombre demasiado corto' : (nombre.length > 100 ? 'Nombre demasiado largo' : '');
}
function validarApellido(nombre) {
    return nombre.length < 3 ? 'Apellido demasiado corto' : (nombre.length > 100 ? 'Apellido demasiado largo' : '');
}
function validarEmail(email) {
    // Devuelve un mensaje de error si el valor no es válido, de lo contrario, devuelve ''
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email) ? '' : 'Email no válido';
}
function validatePassword(password) {
    // Devuelve un mensaje de error si el valor no es válido, de lo contrario, devuelve ''
    return password.length < 8 ? 'Contraseña demasiado corta' : (password.length > 20 ? 'Contraseña demasiado larga' : '');
}
function validarCelular(numero) {
    // Devuelve un mensaje de error si el valor no es válido, de lo contrario, devuelve ''
    return /^\d{10}$/.test(numero) ? '' : 'El numero de celular debe tener 10 dígitos';
}


//Enfocado en la parte de register.php

document.getElementById('dateOfBirth').addEventListener('blur', function () {
    // Obtén el valor ingresado por el usuario
    var inputDate = this.value;

    // Verifica si se ingresó una fecha
    if (inputDate) {
        // Crea un objeto de fecha con la fecha ingresada
        var fechaNacimiento = new Date(inputDate);

        // Obtiene el año de la fecha de nacimiento
        var year = fechaNacimiento.getFullYear();

        // Verifica si el año es mayor o igual a 
        if (year < 1924) {
            // Muestra un mensaje de error si la fecha de nacimiento es anterior a 1900
            alert('La fecha de nacimiento debe ser posterior a 1924.');
            this.value = '';  // Limpia el campo si la fecha no es válida
        }
        if(year>2005)
        {
            alert('Debe ser mayor de edad para registrarse.');
            this.value = '';  // Limpia el campo si la fecha no es válida
        }
    }
});