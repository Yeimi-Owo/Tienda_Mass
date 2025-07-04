// Variable que mantiene el estado visible del carrito
var carritoVisible = false;

if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready);
} else {
    ready();
}

function ready() {
    document.querySelectorAll('.btn-eliminar').forEach(button => {
        button.addEventListener('click', eliminarItemCarrito);
    });

    document.querySelectorAll('.sumar-cantidad').forEach(button => {
        button.addEventListener('click', sumarCantidad);
    });

    document.querySelectorAll('.restar-cantidad').forEach(button => {
        button.addEventListener('click', restarCantidad);
    });

    document.querySelectorAll('.boton-item').forEach(button => {
        button.addEventListener('click', agregarAlCarritoClicked);
    });

    document.querySelector('.btn-pagar').addEventListener('click', pagarClicked);
}

function actualizarTotalCarrito() {
    let total = 0;
    document.querySelectorAll(".carrito-item").forEach(item => {
        let precioElemento = parseFloat(item.querySelector(".carrito-item-precio").textContent.replace("S/", "").trim());
        let cantidadItem = parseInt(item.querySelector(".carrito-item-cantidad").value);
        if (isNaN(cantidadItem) || cantidadItem < 1) cantidadItem = 1;
        total += precioElemento * cantidadItem;
    });
    document.getElementById("carrito-precio-total").innerText = 'S/ ' + total.toFixed(2);
}

function pagarClicked(event) {
    event.preventDefault();
    const carritoItems = [];
    document.querySelectorAll(".carrito-item").forEach(item => {
        const id = item.getAttribute("data-id");
        const nombre = item.querySelector(".carrito-item-titulo").textContent;
        const precio = parseFloat(item.querySelector(".carrito-item-precio").textContent.replace("S/", "").trim());
        const cantidad = parseInt(item.querySelector(".carrito-item-cantidad").value);
        carritoItems.push({ idProductos: id, nombre, precio, cantidad });
    });

    Swal.fire({
        title: '¿Deseas seguir comprando o pagar?',
        text: 'Serás redirigido a los métodos de pago.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ir a pagar',
        cancelButtonText: 'Seguir comprando'
    }).then((result) => {
        if (result.isConfirmed) {
            localStorage.setItem("carrito", JSON.stringify(carritoItems));
            Swal.fire({
                icon: 'success',
                title: 'Redirigiendo...',
                text: 'En breve irás al formulario de pago.',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout(() => {
                window.location.href = "../../Controlador/Validacion/checkout.html";
            }, 1600);
        } else {
            Swal.fire({
                icon: 'info',
                title: 'Puedes seguir navegando 😊',
                text: 'Tu carrito se mantiene activo.',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
}

function agregarAlCarritoClicked(event) {
    event.stopPropagation();
    var button = event.target;
    var item = button.closest(".item");
    var id = item.getAttribute("data-id");
    var titulo = item.querySelector(".titulo-item").textContent;
    var precio = item.querySelector(".precio-item").textContent.replace("S/", "").trim();
    var imagenSrc = item.querySelector(".img-item").src;

    var productoExistente = document.querySelector(`.carrito-item[data-id="${id}"]`);
    if (productoExistente) {
        Swal.fire({
            icon: 'info',
            title: 'Producto ya en el carrito',
            text: 'Puedes cambiar la cantidad desde ahí.',
            confirmButtonColor: '#b32323',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    agregarItemAlCarrito(id, titulo, precio, imagenSrc);
    hacerVisibleCarrito();
}

function hacerVisibleCarrito() {
    const carrito = document.querySelector('.carrito');
    const items = document.querySelector('.contenedor-items');
    carrito.style.marginRight = '0';
    carrito.style.opacity = '1';
    carrito.style.pointerEvents = 'auto';
    items.style.width = '60%';
}

function agregarItemAlCarrito(id, titulo, precio, imagenSrc) {
    var itemsCarrito = document.getElementsByClassName("carrito-items")[0];
    if (!itemsCarrito) {
        itemsCarrito = document.createElement("div");
        itemsCarrito.classList.add("carrito-items");
        var carrito = document.getElementsByClassName("carrito")[0];
        carrito.appendChild(itemsCarrito);
    }

    var item = document.createElement("div");
    item.classList.add("carrito-item");
    item.setAttribute("data-id", id);
    item.setAttribute("data-cantidad", "1");

    var itemCarritoContenido = `
        <img src="${imagenSrc}" width="80px" alt="">
        <div class="carrito-item-detalles">
            <span class="carrito-item-titulo">${titulo}</span>
            <div class="selector-cantidad">
                <i class="fa-solid fa-minus restar-cantidad"></i>
                <input type="number" value="1" class="carrito-item-cantidad" min="1" max="50">
                <i class="fa-solid fa-plus sumar-cantidad"></i>
            </div>
            <span class="carrito-item-precio">${precio}</span>
        </div>
        <button class="btn-eliminar"><i class="fa-solid fa-trash"></i></button>
    `;

    item.innerHTML = itemCarritoContenido;
    itemsCarrito.append(item);

    item.querySelector(".btn-eliminar").addEventListener("click", eliminarItemCarrito);
    item.querySelector(".restar-cantidad").addEventListener("click", restarCantidad);
    item.querySelector(".sumar-cantidad").addEventListener("click", sumarCantidad);

    actualizarTotalCarrito();
}

// Sumar cantidad con límite de 50
function sumarCantidad(event) {
    var item = event.target.closest('.carrito-item');
    var cantidadItem = item.querySelector('.carrito-item-cantidad');
    let actualCantidad = parseInt(cantidadItem.value);

    if (actualCantidad < 50) {
        cantidadItem.value = actualCantidad + 1;
        item.setAttribute('data-cantidad', cantidadItem.value);
        actualizarTotalCarrito();
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Máximo permitido',
            text: 'Solo puedes comprar hasta 50 unidades de este producto.',
            confirmButtonColor: '#b32323'
        });
    }
}

// Restar cantidad
function restarCantidad(event) {
    var item = event.target.closest('.carrito-item');
    var cantidadItem = item.querySelector('.carrito-item-cantidad');
    let nuevaCantidad = parseInt(cantidadItem.value) - 1;

    if (nuevaCantidad >= 1) {
        cantidadItem.value = nuevaCantidad;
        item.setAttribute('data-cantidad', nuevaCantidad);
        actualizarTotalCarrito();
    }
}

// Validar manualmente cantidades escritas
document.addEventListener("input", function (event) {
    if (event.target.classList.contains("carrito-item-cantidad")) {
        let input = event.target;
        let valor = parseInt(input.value);

        if (isNaN(valor) || valor < 1) {
            input.value = 1;
        } else if (valor > 50) {
            input.value = 50;
            Swal.fire({
                icon: 'warning',
                title: 'Límite de cantidad',
                text: 'No puedes exceder 50 unidades.',
                confirmButtonColor: '#b32323'
            });
        }
        actualizarTotalCarrito();
    }
});

function eliminarItemCarrito(event) {
    var item = event.target.closest('.carrito-item');
    if (item) {
        item.remove();
        actualizarTotalCarrito();
        ocultarCarrito();
    }
}

function ocultarCarrito() {
    var carritoItems = document.getElementsByClassName('carrito-items')[0];
    if (carritoItems.childElementCount == 0) {
        var carrito = document.getElementsByClassName('carrito')[0];
        carrito.style.marginRight = '-100%';
        carrito.style.opacity = '0';
        carritoVisible = false;
        var items = document.getElementsByClassName('contenedor-items')[0];
        items.style.width = '100%';
    }
}
