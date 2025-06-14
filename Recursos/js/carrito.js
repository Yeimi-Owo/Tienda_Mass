let input = document.getElementById('buscar');

input.addEventListener('keyup', (event) => {
    let texto = event.target.value;
    console.log(texto);
})


function addProducto(id, token) {
    let url = '../../Controllers/CarritoController.php'
    let formData = new FormData()
    formData.append('id', id)
    formData.append('token', token)

    fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
    }).then(response => response.json())
        .then(data => {
            if (data.ok) {
                let elemento = document.getElementById("num_cart")
                elemento.innerHTML = data.numero

            }
        })
}




