function actualizaCantidad(cantidad, id) {
    let url = '../../Controllers/actualizar_carrito.php'
    let formData = new FormData()
    formData.append('action', 'agregar')
    formData.append('id', id)
    formData.append('cantidad', cantidad)

    fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
    }).then(response => response.json())
    .then(data => {
      if (data.ok) {
        let divsubtotal = document.getElementById("subtotal_" + id)
        divsubtotal.innerHTML = data.sub 

        let total = 0.00
        let list = document.getElementsByName('subtotal[]')

        for(let i = 0; i < list.length; i++){
          total += parseFloat(list[i].innerHTML.replace(/[S/,.]/g, ''))
        }

        total = new Intl.NumberFormat('PEN',{
          minimumFractionDigits: 2
        }).format(total)
        document.getElementById('total').innerHTML = php
      }
    })
}