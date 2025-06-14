document.getElementById("xnombreUser").style.display = "none";
document.getElementById("xcorreoUser").style.display = "none";

function Mostrar_TextBox_Nombre(){
    var cont = 0;
    if(cont == 0){
        document.getElementById("xcodigoUser").style.display = "none";
        document.getElementById("xcorreoUser").style.display = "none";
        document.getElementById("xnombreUser").style.display = "block";
    }
}
function Mostrar_TextBox_Codigo(){
    var cont = 0;
    if(cont == 0){
        document.getElementById("xcorreoUser").style.display = "none";
        document.getElementById("xnombreUser").style.display = "none";
        document.getElementById("xcodigoUser").style.display = "block";
    }
}
function Mostrar_TextBox_Correo(){
    var cont = 0;
    if(cont == 0){
        document.getElementById("xcodigoUser").style.display = "none";
        document.getElementById("xnombreUser").style.display = "none";
        document.getElementById("xcorreoUser").style.display = "block";
    }
}