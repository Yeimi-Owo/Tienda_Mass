const imagenes = document.querySelector('.img-galeria')
const imagenesLight = document.querySelector('.agregar-imagen')
const contenedorLight = document.querySelector('.imagen-light')

console.log(imagenes)
console.log(imagenesLight)
console.log(contenedorLight)

imagenes.forEach(imagen => {
    imagen.addEventListener('click', ()=>{
        console.log(imagen.getAttribute('src'));
    })
});

const aparecerImagen = (imagen)=>{

}