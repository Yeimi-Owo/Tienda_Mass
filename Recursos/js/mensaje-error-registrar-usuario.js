function errores(){

    var nombre = document.getElementById("nombre_usuario").value;
    var email = document.getElementById("email").value;
    var contra = document.getElementById("contrasena").value;

    if(nombre.length == 0 || email.length == 0 || contra.length == 0){
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Falta campos por Completar',
          });
    } else if(nombre.length < 6 ){
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El Usuario debe contar con 6 Caracteres a más',
          });
    } else if(pruebaemail(email)){

    } else if(contra.length < 8){
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El Contraseña debe contar con 8 Caracteres a más',
          });
    }
    

    
}
//================================================================================
function validarlogitudusuario(el) {
    if (el.value.length < 5) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El Usuario debe contar con mas de 5 Caracteres',
          });
        document.getElementById("nombre_usuario").value = "";

    } else{

    }
}
function validarlogitudcontraseña(el) {
    if (el.value.length < 8) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'La contraseña debe contar con 8 caracteres a mas',
          });
        document.getElementById("contrasena").value = "";
    } else{
    }
}

function emailP(valor){
    re=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/
    if(!re.exec(valor))    {
       alert("dad");
    }else{
        alert("121");
    }
}
function pruebaemail (valor){
	re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
	if(!re.exec(valor)){
		Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Correo Invalido',
          });
          document.getElementById("email").value = "";
	}
}


function validarEmail(el) {

    var expReg= /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;
    var esV= expReg.test(el);

    if(esV==true){
     alert("La dirección de email es correcta.");
    } else {
     alert("La dirección de email es incorrecta.");
    }
  }