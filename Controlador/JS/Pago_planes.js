document.getElementById("cancelButton").addEventListener("click", function() {
    window.location.href = "../../Vista/Home/index3.html";
});

document.getElementById("payButton").addEventListener("click", function(event) {
    event.preventDefault();

    var tarjeta = document.getElementById("NumeroTarjeta").value;
    var fecha = document.getElementById("FechaExpiracion").value;
    var cvv = document.getElementById("CCV").value;

    if (tarjeta.trim() === '' && fecha.trim() === '' && cvv.trim() === '') {
        // Si todos los campos están vacíos, también se considera una cancelación del pago
        window.location.href = "../../Vista/Home/index3.html";
        return;
    }

    if (tarjeta.trim() === '' || fecha.trim() === '' || cvv.trim() === '') {
        alert('Por favor, complete todos los campos del formulario.');
        return;
    }

    // Realizar el envío del formulario o realizar otras acciones necesarias

    alert('Pago realizado exitosamente');
    this.reset(); // Limpiar los campos del formulario
});