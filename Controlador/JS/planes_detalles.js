
function actualizarSubtotal(id_planes, precio) {
  let cantidad = parseInt(document.getElementById('cantidad' + id_planes).value);
  let subtotal = cantidad * precio;
  document.getElementById('subtotal' + id_planes).innerHTML = "<?php echo MONEDA; ?>" + subtotal.toFixed(2);
  calculateTotal();
}

function calculateTotal() {
  let subtotals = document.getElementsByName('subtotal[]');
  let total = 0;
  for (let i = 0; i < subtotals.length; i++) {
    total += parseFloat(subtotals[i].innerText.replace("<?php echo MONEDA; ?>", ""));
  }

  let igv = total * 0.01;
  let totalConIgv = total + igv;

  document.getElementById('total').innerHTML = "<?php echo MONEDA; ?>" + total.toFixed(2);
  document.getElementById('totalConIgv').innerHTML = "<?php echo MONEDA; ?>" + totalConIgv.toFixed(2);
}

    function eliminarPlan(id_planes) {
      // Aquí realizamos la solicitud AJAX para eliminar el plan del carrito
      fetch('../../Controlador/Validacion/eliminar_plan_carrito.php', { // Ajustar la URL a la ubicación correcta del archivo
        method: 'POST',
        body: JSON.stringify({ id_planes: id_planes }),
        headers: {
          'Content-Type': 'application/json'
        }
      })
      .then(response => response.json())
      .then(data => {
        // Si la eliminación es exitosa, actualizamos la lista de productos mostrada
        // Puedes implementar la lógica según la respuesta de tu backend
        if (data.success) {
          location.reload(); // Recargar la página para reflejar los cambios
        } else {
          console.error('Error al eliminar el plan del carrito:', data.message);
        }
      })
      .catch(error => {
        console.error('Error al procesar la solicitud', error);
      });
    }

    function elimina(id_planes) {
      let eliminaModal = new bootstrap.Modal(document.getElementById('eliminaModal'));
      let buttonElimina = document.getElementById('btn-elimina');
      buttonElimina.value = id_planes;
      eliminaModal.show();
    }

