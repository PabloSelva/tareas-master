
$(document).ready(function () {
    $('#manage_employee').submit(function (e) {
        e.preventDefault();

        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var department_id = $('#department_id').val();
        
        var email = $('#email').val();
        

        // Función de validación
        if (!validarCampos(firstname, lastname,department_id,email)) {
            return;
        }

        // Función de validación para los campos del formulario
        function validarCampos(firstname, lastname,department_id,email) {
            // Validar campos vacíos
            if (firstname === '' || lastname === '' || department_id === '' || email === '') {
                alert('Por favor, completa todos los campos');
                return false;
            }

            // Validar correo electrónico
            if (!validarCorreo(email)) {
                alert('Por favor, ingresa un correo electrónico válido');
                return false;
            }
            // Validar nombre y mensaje (permitir solo espacios cuando se ingrese texto)
            if (nombre.trim() === '' || lastname.trim() === '') {
                alert('Los campos no pueden tener espacios antes de ingresar el texto');
                return false;
            }



            return true;
        }

        // Función para validar el formato de correo electrónico
        function validarCorreo(email) {
            // Expresión regular para validar correo electrónico
            var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return expresion.test(email);
        }

        // Resto del código de validación y envío del formulario
        // ...

        // Datos del formulario
        var datos = {
            nombre: firstname,
            apellido: lastname,
            departamento: department_id,
            correo: mail
            
        };

        // Enviar datos a través de AJAX
        $.ajax({
            type: 'POST',
            url: '../../enviar_correo.php',
            data: datos,
            success: function (response) {
                alert(response);
                $('#manage_employee')[0].reset();
            },
            error: function () {
                alert('Hubo un error al enviar el correo');
            }
        });
    });
});
