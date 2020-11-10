var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //Enero is 0!
var yyyy = today.getFullYear();
if( dd < 10 ){
    dd ='0'+ dd
} 
if( mm < 10 ){
    mm ='0'+ mm
} 

today = yyyy+'-'+mm+'-'+dd;
const fecha_element = document.getElementById("fecha-solicitada");
fecha_element.setAttribute("min", today);



fecha_element.addEventListener('change', e => {
    const fecha_seleccionada = new Date();
    console.log(e.target.value);
});