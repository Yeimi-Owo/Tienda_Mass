let eliminaModal = document.getElementById('eliminaModal')
    eliminaModal.addEventListener('show.bs.modal', function(event){
        let button = event.relatedTarget
        let id= button.getAtribute('data.bs.id')
        let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
        buttonElimina.value=id
    })


function actualizaCantidad(cantidad, id) {
    let url = '../../Controlador/Validacion/actualizar_carrito.php';
    let formData = new FormData();
    formData.append('action', 'agregar');
    formData.append('id_planes', id);
    formData.append('cantidad', cantidad);

    fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors',
    })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            let divsubtotal = document.getElementById('subtotal' + id);
            divsubtotal.innerHTML = data.sub;

            // Recalcular el total del carrito
            let total = 0.00;
            let list = document.getElementsByName('subtotal[]');

            for (let i = 0; i < list.length; i++) {
                let subtotal = parseFloat(list[i].innerHTML.replace(/[^\d.,]/g, '').replace(',', '.'));
                total += subtotal;
            }

            total = new Intl.NumberFormat('es-PE', {
                style: 'currency',
                currency: 'PEN',
                minimumFractionDigits: 2
            }).format(total);

            console.log('Total:', total); // Imprimir el valor del total en la consola

            document.getElementById('total').innerHTML = total;
        }
    })
    .catch(error => console.error('Error:', error));
}


function eliminar() {
    let botonElimina = document.getElementById('btn-elimina')
    let id = botonElimina.value

    let url = '../../Controlador/Validacion/actualizar_carrito.php';
    let formData = new FormData();
    formData.append('action', 'eliminar');
    formData.append('id_planes', id);

    fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors',
    })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            location.reload()
        }
    })
    .catch(error => console.error('Error:', error));
}