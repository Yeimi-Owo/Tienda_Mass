const plus = document.querySelector(".plus"),
    minus = document.querySelector(".minus"),
    num = document.querySelector(".num");

let a = 1;

plus.addEventListener("click", () => {
    a++;
    a = (a < 10) ? "0" + a : a;
    num.innerText = a
    console.log(a);
});
minus.addEventListener("click", () => {
    if (a > 1) {
        a--;
        a = (a < 10) ? "0" + a : a;
        num.innerText = a
    }
});



/* const myInput = document.getElementById("my-input");
function stepper(btn){
    let id = btn.getAttribute("id");
    let min = myInput.getAttribute("min");
    let max = myInput.getAttribute("max");
    let step = myInput.getAttribute("step");
    let val = myInput.getAttribute("value");
    /* let calcStep = (id == "increment") ? (step*1) : (step*-1);
    let newValue=parseInt(val) + calcStep; */

/* console.log(id,min,max,step,val); */


/* if(newValue >= min && newValue<= max){
    myInput.setAttribute("value" , newValue)
}
 
} */



/* const inputCantidad = document.querySelector(".  input-cantidad")
const btnmas = document.querySelector('#mas')
const btnmenos = document.querySelector('#menos')

var valueByDefault=parseInt(inputCantidad.value)


btnmas.addEventListener("click",() => {
    valueByDefault += 1
    inputCantidad.value = valueByDefault
})

btnmenos.addEventListener("click",()=>{
    valueByDefault -= 1
    inputCantidad.value = valueByDefault
}) */


