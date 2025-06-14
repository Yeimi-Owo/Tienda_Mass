document.getElementById("ventana-registrarse").style.display = "none";

function Mlogin() {
  var btnlogin = document.getElementById("text-login");
  var btnRegi = document.getElementById("text-register");
  var cont = 0;

  if (cont == 0) {
    document.getElementById("ventana-registrarse").style.display = "none";
    document.getElementById("ventana-login").style.display = "block";
  }
}
function Mregi() {
  var btnRegi = document.getElementById("text-register");
  var btnlogin = document.getElementById("text-login");
  var cont = 0;

  if (cont == 0) {
    document.getElementById("ventana-login").style.display = "none";
    document.getElementById("ventana-registrarse").style.display = "block";
  }
}

function mostrarPass() {
  var contra = document.getElementById("btn-pass");
  var btn = document.getElementById("btn");

  if (contra.type == "password") {
    contra.type = "text";
    btn.classList.remove("iconocontra");
    btn.classList.add("iconocontranegro");
  } else {
    contra.type = "password";
    btn.classList.remove("iconocontranegro");
    btn.classList.add("iconocontra");
  }
}

function mostrarPass2() {
  var contra = document.getElementById("btn-pass2");
  var btn = document.getElementById("btn2");

  if (contra.type == "password") {
    contra.type = "text";
    btn.classList.remove("iconocontra2");
    btn.classList.add("iconocontranegro2");
  } else {
    contra.type = "password";
    btn.classList.remove("iconocontranegro2");
    btn.classList.add("iconocontra2");
  }
}

function cambiopass_mostrarPass() {
  var contraseña1 = document.getElementById("password");
  var contraseña2 = document.getElementById("password2");
  var btn = document.getElementById("btn");

  if (contraseña1.type == "password" && contraseña2.type == "password") {
    contraseña1.type = "text";
    contraseña2.type = "text";
    btn.classList.remove("iconocontra2");
    btn.classList.add("iconocontranegro2");
  } else {
    contraseña1.type = "password";
    contraseña2.type = "password";
    btn.classList.remove("iconocontranegro2");
    btn.classList.add("iconocontra2");
  }
}

function ActiveTexBox() {
  var btnuser = document.getElementById("btn-user-login");
  var cont = 0;

  if (cont == 0) {
    btnuser.classList.remove("form-control texbox-usuario");
    btnuser.classList.add("form-control texbox-usuario active-texbox");
    alert("ada");
  }
}

function activar() {
  alert("Inicio de Sesion Exitosamente");
  targer.set;
}

function validarlogitudusuario(el) {
  if (el.value.length < 5) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "El Usuario debe contar con mas de 5 Caracteres",
    });
    document.getElementById("texbox-usuario-registrar").value = "";
  } else {
  }
}

function validarlogitudcontraseña(el) {
  if (el.value.length < 8) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "La contraseña debe contar con 8 caracteres a mas",
    });
    document.getElementById("btn-pass2").value = "";
  } else {
  }
}
function validarlogitudcontraseña_cambiopass(el) {
  var mensajeE = document.getElementById("text_error");

  if (el.value.length < 8) {
    document.getElementById("text_error").value = "eRROR DE CONTRA";
    document.getElementById("btn-pass2").value = "";
  } else {
  }
}

function verificar_telefono() {
  var textotelefono = document.getElementById("texbox-usuario-registrar").value;
  var numerocaracterestextotelefono = textotelefono.replace(" ", "");
  numerocaracterestextotelefono = numerocaracterestextotelefono.length;

  if (textotelefono.length <= 7 || textotelefono.length >= 11) {
    document.getElementById("mensaje").textContent =
      "Ingrese un usuario de 8 a 10 letras.";
    document.getElementById("texbox-usuario-registrar").value = "";

    document.getElementById("ventana-login").style.display = "none";
    document.getElementById("ventana-registrarse").style.display = "block";
  } else {
    document.getElementById("mensaje").textContent = "";
  }
}
