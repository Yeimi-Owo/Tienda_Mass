$(document).ready(function () {
    // Verificar si estamos en la página de inicio
    if (window.location.pathname === '/Vista/Home/Index.html','/Vista/Home/Nosotros.html', '/Vista/Home/Pago.html') {
        // Realizar la solicitud AJAX para obtener el estado de inicio de sesión
        $.ajax({
            url: '../../Controlador/Validacion/check_login.php',
            method: 'GET',
            success: function (response) {
                if (response.logged_in) {
                    // Usuario inició sesión, mostrar el enlace y el icono de Cerrar Sesión
                    $('#sesionLink').attr('href', '/Vista/User/Registro-Login.html');
                    $('#sesionIcon').removeClass('fa-user').addClass('fa-door-closed');
                } else {
                    // Usuario no ha iniciado sesión, mostrar el enlace y el icono de Iniciar Sesión
                    $('#sesionLink').attr('href', '/Vista/User/Registro-Login.html');
                    $('#sesionIcon').removeClass('fa-door-closed').addClass('fa-user');
                }
            },
            error: function () {
                // Manejar errores de la solicitud AJAX
                console.log('Error al obtener el estado de inicio de sesión.');
            }
        });
    }

    // Manejar clic en el enlace de cerrar sesión
    $('#sesionLink').click(function (e) {
        e.preventDefault();

        // Realizar la solicitud AJAX para cerrar sesión
        $.ajax({
            url: '../../Controlador/Validacion/cerrar_sesion.php',
            method: 'POST',
            success: function (response) {
                // Redireccionar a la página de inicio de sesión
                window.location.href = '/Vista/User/Registro-Login.html';
            },
            error: function () {
                // Manejar errores de la solicitud AJAX
                console.log('Error al cerrar sesión.');
            }
        });
    });



});


