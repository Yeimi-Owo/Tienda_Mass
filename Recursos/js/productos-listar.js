//document.getElementById("nombre").style.display = "none";
/*
var checkbox_COD = document.getElementById('flexRadioDefault2');
checkbox_COD.addEventListener("change", validaCheckbox_COD, false);

var checkbox_NOM = document.getElementById('flexRadioDefault1');
checkbox_NOM.addEventListener("change", validaCheckbox_NOM, false);
*/

var checkbox_COD = document.getElementById('flexRadioDefault2');

function vali_COD(){
    document.getElementById("nombre").style.display = "none";
    document.getElementById("id").style.display = "block";
}

function valicod(){
    var checked = checkbox.checked;
    if(checked){
        document.getElementById("nombre").style.display = "none";
        document.getElementById("id").style.display = "block";
    }
}

function validaCheckbox_COD(){
    var checked = checkbox.checked;
    if(checked){
        document.getElementById("nombre").style.display = "none";
        document.getElementById("id").style.display = "block";
    }
}

function validaCheckbox_NOM(){
    var checked = checkbox.checked;
    if(checked){
        document.getElementById("id").style.display = "none";
        document.getElementById("nombre").style.display = "block";
    }
}









function Mostrar_TextBox_Nombre(){
    var cont = 0;
    if(cont == 0){
        //document.getElementById("flexRadioDefault1").checked = true;
        //document.getElementById("flexRadioDefault2").checked = false;
        document.getElementById("id").style.display = "none";
        document.getElementById("nombre").style.display = "block";
        
    }
    z=1;
}


function Mostrar_TextBox_Codigo(){
    var cont = 0;
    if(cont == 0){
        //document.getElementById("flexRadioDefault2").checked = true;
        //document.getElementById("flexRadioDefault1").checked = false;
        document.getElementById("nombre").style.display = "none";
        document.getElementById("id").style.display = "block";
        z=2;
    }
}

window.onload = function() {

    
};