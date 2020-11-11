/*** Definciones de funciones ***/
async function get_today_citas(today){

    try {
        const respuesta = await fetch(`http://localhost/citas-uiw/app-citas/index.php/Cita/get_dates/${today}`);
        const json_respuesta = await respuesta.json();
        off_overlay();

        //5.Mostrar las horas disponibles
        display_hours(json_respuesta);
    } catch (error) {
        alert(error);
    }
}

function get_format_date(today_date){
    var dd = today_date.getDate();
    var mm = today_date.getMonth() + 1; //Enero is 0!
    var yyyy = today_date.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    const today = yyyy + '-' + mm + '-' + dd;

    return today;
}

function set_min_date(today) {
    const fecha_element = document.getElementById("fecha-solicitada");
    fecha_element.setAttribute("min", today);
    fecha_element.value = today;
}

function off_overlay() {
    const overlay_element = document.getElementsByClassName('overlay')[0];
    overlay_element.style.display = "None";
}

function on_overlay() {
    const overlay_element = document.getElementsByClassName('overlay')[0];
    overlay_element.style.display = "Flex";
}

function display_hours(horas_disponibles) {
    const availables_hours_element = document.getElementById('horas-disponibles');

    Object.values(horas_disponibles).forEach(hora => {
        const option_element = document.createElement('option');
        option_element.value = hora;
        option_element.innerText = hora;

        availables_hours_element.appendChild(option_element);
    });

}
/*** Fin ***/

//1. Get fecha actual
const today = new Date();

//2. Formatear la fecha de hoy
const formatted_date = get_format_date(today);

//3. Get citas de hoy
get_today_citas(formatted_date);

//4. Set la fecha a hoy
set_min_date(formatted_date);



const fecha_element = document.getElementById("fecha-solicitada");
fecha_element.addEventListener('change', e => {
    const fecha_seleccionada = new Date();
    console.log(new Date(e.target.value));
});