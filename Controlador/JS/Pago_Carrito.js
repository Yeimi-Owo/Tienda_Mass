document.getElementById("cancelButton").addEventListener("click", function() {
    window.location.href = "../../Vista/Home/Tienda.html";
});

document.getElementById("paymentForm").addEventListener("submit", function(event) {
    event.preventDefault();

    var nombre = document.getElementById("nombre").value;
    var tarjeta = document.getElementById("tarjeta").value;
    var fecha = document.getElementById("fecha").value;
    var cvv = document.getElementById("cvv").value;

    if (nombre.trim() === '' && tarjeta.trim() === '' && fecha.trim() === '' && cvv.trim() === '') {
        // Si todos los campos están vacíos, también se considera una cancelación del pago
        window.location.href = "../../Vista/Home/Tienda.html";
        return;
    }

    if (nombre.trim() === '' || tarjeta.trim() === '' || fecha.trim() === '' || cvv.trim() === '') {
        alert('Por favor, complete todos los campos del formulario.');
        return;
    }

    // Realizar el envío del formulario o realizar otras acciones necesarias

    alert('Pago realizado exitosamente');
    this.reset(); // Limpiar los campos del formulario
});