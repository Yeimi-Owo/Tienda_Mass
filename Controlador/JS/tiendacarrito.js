//Variable que mantiene el estado visible del carrito
var carritoVisible = false;

//Espermos que todos los elementos de la pàgina cargen para ejecutar el script
if(document.readyState == 'loading'){
    document.addEventListener('DOMContentLoaded', ready)
}else{
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
        let idProducto = item.getAttribute("data-id");
        let precioElemento = parseFloat(item.querySelector(".carrito-item-precio").textContent.replace("S/", "").trim());
        let cantidadItem = parseInt(item.querySelector(".carrito-item-cantidad").value);

        console.log("Calculando total:", { id: idProducto, precio: precioElemento, cantidad: cantidadItem });

        if (isNaN(cantidadItem) || cantidadItem < 1) cantidadItem = 1;

        total += precioElemento * cantidadItem;
    });

    document.getElementById("carrito-precio-total").innerText = 'S/ ' + total.toFixed(2);

    console.log("✔ Total actualizado");
}



//Eliminamos todos los elementos del carrito y lo ocultamos
function pagarClicked(event) {
    event.preventDefault();

    let carritoItems = [];

    document.querySelectorAll(".carrito-item").forEach(item => {
        let id = item.getAttribute("data-id");
        let nombre = item.querySelector(".carrito-item-titulo").textContent;
        let precio = parseFloat(item.querySelector(".carrito-item-precio").textContent.replace("S/", "").trim());
        let cantidad = parseInt(item.querySelector(".carrito-item-cantidad").value);

        carritoItems.push({
            idProductos: id,
            nombre: nombre,
            precio: precio,
            cantidad: cantidad
        });
    });

    // Guardamos el carrito en localStorage
    localStorage.setItem("carrito", JSON.stringify(carritoItems));

    // Redirigimos a checkout.html
    window.location.href = "../../Controlador/Validacion/checkout.html";
}

//Funciòn que controla el boton clickeado de agregar al carrito
function agregarAlCarritoClicked(event) {
    event.stopPropagation(); // 

    var button = event.target; //Obtiene el elemento que disparó el evento, que es el botón que se ha clicado.
    var item = button.closest(".item"); 
    var id = item.getAttribute("data-id");
    var titulo = item.querySelector(".titulo-item").textContent;
    var precio = item.querySelector(".precio-item").textContent.replace("S/", "").trim();
    var imagenSrc = item.querySelector(".img-item").src;

    console.log("Intentando agregar producto:", id, titulo, precio);

    // Revisar si el producto ya está en el carrito
    var productoExistente = document.querySelector(`.carrito-item[data-id="${id}"]`);
    if (productoExistente) {
        alert("El producto ya está en el carrito. Puedes cambiar la cantidad.");
        return;
    }

    agregarItemAlCarrito(id, titulo, precio, imagenSrc);
    hacerVisibleCarrito();
}


//Funcion que hace visible el carrito
function hacerVisibleCarrito(){
  const carrito = document.querySelector('.carrito');
  const items = document.querySelector('.contenedor-items');

  carrito.style.marginRight = '0';
  carrito.style.opacity = '1';
  carrito.style.pointerEvents = 'auto';  // Habilita clics nuevamente

  items.style.width = '60%';
}


//Funciòn que agrega un item al carrito
function agregarItemAlCarrito(id, titulo, precio, imagenSrc) {
     
  //obtener el primer elemento con la clase carrito-items en el documento  
  var itemsCarrito = document.getElementsByClassName("carrito-items")[0];

  if (!itemsCarrito) { //comprueba si itemsCarrito es undefined o null
    itemsCarrito = document.createElement("div"); //Si no existe, se crea un nuevo elemento div
    itemsCarrito.classList.add("carrito-items"); //Se añade la clase carrito-items al nuevo div
    var carrito = document.getElementsByClassName("carrito")[0]; //Se busca el primer elemento con la clase carrito
    carrito.appendChild(itemsCarrito); //añade el nuevo div (itemsCarrito) como hijo del contenedor carrito
  }
    // Revisar si el producto ya está en el carrito
    var carritoExistente = document.querySelector(`.carrito-item[data-id="${id}"]`);
    if (carritoExistente) {
        alert("El producto ya está en el carrito. Puedes cambiar la cantidad.");
        return;
    }

    // Crear el elemento del producto sin duplicar la clase
    var item = document.createElement("div");
    item.classList.add("carrito-item");
    // Asignar atributos de datos al contenedor principal
    item.setAttribute("data-id", id);
    item.setAttribute("data-cantidad", "1");

    // Construir el contenido HTML sin envolverlo en otro contenedor con la clase "carrito-item"
    var itemCarritoContenido = `
        <img src="${imagenSrc}" width="80px" alt="">
        <div class="carrito-item-detalles">
            <span class="carrito-item-titulo">${titulo}</span>
            <div class="selector-cantidad">
                <i class="fa-solid fa-minus restar-cantidad"></i>
                <input type="text" value="1" class="carrito-item-cantidad" disabled>
                <i class="fa-solid fa-plus sumar-cantidad"></i>
            </div>
            <span class="carrito-item-precio">${precio}</span>
        </div>
        <button class="btn-eliminar">
            <i class="fa-solid fa-trash"></i>
        </button>
    `;

    item.innerHTML = itemCarritoContenido;
    itemsCarrito.append(item);

    // Asignar eventos a los elementos recién creados
    item.getElementsByClassName("btn-eliminar")[0].addEventListener("click", eliminarItemCarrito);
    item.querySelector(".restar-cantidad").addEventListener("click", restarCantidad);
    item.querySelector(".sumar-cantidad").addEventListener("click", sumarCantidad);

    actualizarTotalCarrito();
}


//Aumento en uno la cantidad del elemento seleccionado
function sumarCantidad(event) { 
    var buttonClicked = event.target; //Obtiene el elemento que disparó el evento, que es el botón que se ha clicado.
    //Usa closest para buscar el elemento más cercano con la clase .carrito-item, que representa el ítem específico en el carrito.
    var item = buttonClicked.closest('.carrito-item'); 
    //Busca el campo de entrada que contiene la cantidad del ítem dentro del item
    var cantidadItem = item.querySelector('.carrito-item-cantidad');

    let nuevaCantidad = parseInt(cantidadItem.value) + 1;
    cantidadItem.value = nuevaCantidad;
    
    // Sincronizar data-cantidad con el input visual
    item.setAttribute('data-cantidad', nuevaCantidad);

    actualizarTotalCarrito();
}

function restarCantidad(event) {
    var buttonClicked = event.target;
    var item = buttonClicked.closest('.carrito-item');
    var cantidadItem = item.querySelector('.carrito-item-cantidad');

    let nuevaCantidad = parseInt(cantidadItem.value) - 1;
    if (nuevaCantidad >= 1) {
        cantidadItem.value = nuevaCantidad;
        item.setAttribute('data-cantidad', nuevaCantidad);
    }

    actualizarTotalCarrito();
}



//Elimino el item seleccionado del carrito
function eliminarItemCarrito(event){
    //permite obtener el ítem específico del carrito al que pertenece el botón que se ha clicado
    var item = event.target.closest('.carrito-item');
  if (item) {
    item.remove();
    actualizarTotalCarrito();
    ocultarCarrito();
  }
}
//Funciòn que controla si hay elementos en el carrito. Si no hay oculto el carrito.
function ocultarCarrito(){
    var carritoItems = document.getElementsByClassName('carrito-items')[0];
    if(carritoItems.childElementCount==0){
        var carrito = document.getElementsByClassName('carrito')[0];
        carrito.style.marginRight = '-100%';
        carrito.style.opacity = '0';
        carritoVisible = false;
    
        var items =document.getElementsByClassName('contenedor-items')[0];
        items.style.width = '100%';
    }
}