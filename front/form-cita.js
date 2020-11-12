/*** Definiciones de funciones ***/

async function get_today_citas(today) {

    try {
        const respuesta = await fetch(`http://localhost/citas-uiw/app-citas/index.php/Cita/get_dates/${today}`);
        const json_respuesta = await respuesta.json();

        //5.Mostrar las horas disponibles
        display_hours(json_respuesta);

        off_overlay();
    } catch (error) {
        Swal.fire({
            title: 'Error',
            text: 'Oucrrió un error al obtener horarios disponibles',
            icon: 'error',
            confirmButtonText: 'Ok'
        });
        off_overlay();
    }
}

async function crear_cita(data) {

    try {
        const respuesta = await fetch(`http://localhost/citas-uiw/app-citas/index.php/Cita/crear/`, {
            method: 'POST',
            body: data
        });
        const json_respuesta = await respuesta.json();

        //Mandar a otra pagina
        alert(json_respuesta);
        console.log(json_respuesta);

    } catch (error) {
        Swal.fire({
            title: 'Error',
            text: 'Oucrrió un error al crear su cita, intente más tarde',
            icon: 'error',
            confirmButtonText: 'Ok'
        });
        off_overlay();
    }

}

function es_fin_semana(date) {
    //Validar si es fin de semana
    if (date.getDay() == 6 || date.getDay() == 0) {
        return true;
    } else {
        return false;
    }
}

//Aumentar dias hasta el próximo habil
function aumentar_dias(date) {
    
    //Su es Sábado
    if (date.getDay() == 6) {
        date.setDate(date.getDate() + 2);
    }

    //Su es Domingo
    if (date.getDay() == 0) {
        date.setDate(date.getDate() + 1);
    }

    const formatted_date = get_format_date(date);
    fecha_element.value = formatted_date;
    get_today_citas( formatted_date );
}

function get_format_date(today_date) {
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

    if (availables_hours_element.hasChildNodes) {

        while (availables_hours_element.firstChild) {
            availables_hours_element.removeChild(availables_hours_element.firstChild);
        }
    }

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



//Proceso de selecionar una cita y obtener las horas disponibles
const fecha_element = document.getElementById("fecha-solicitada");
fecha_element.addEventListener('change', e => {

    //Si es un valor valido
    if (!e.target.value) {
        return;
    }
    on_overlay();
    const fecha_seleccionada = new Date(e.target.value);
    fecha_seleccionada.setDate(fecha_seleccionada.getDate() + 1);
    const formatted_date = get_format_date(fecha_seleccionada);

    //Validar si es fin de semana
    if ( es_fin_semana(fecha_seleccionada) ) {
        Swal.fire({
            title: 'Error',
            text: 'No puedes agendar citas Sábados y Domingos',
            icon: 'error',
            confirmButtonText: 'Ok'
        });

        aumentar_dias(fecha_seleccionada);
    }
    get_today_citas(formatted_date);
});

//Proceso de crear una cita
const form = document.getElementById('crear-cita-form');
form.addEventListener('submit', e => {
    on_overlay();
    e.preventDefault();

    const dataform = new FormData(form);
    crear_cita(dataform);
});