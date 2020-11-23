<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cita extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->model('Cita_model');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('citas/create-form');
    }

    public function ver_citas()
    {
        if (!$this->session->logged_in) {
            header("Location:" . base_url() . 'index.php/Cita/login/');
            exit();
        }

        //Obtengo las citas para hoy
        $fecha_hoy = date('Y-m-d');
        $data = array(
            'citas' => $this->Cita_model->get_dates($fecha_hoy),
            'fecha' => $fecha_hoy
        );
        $this->load->view('citas/ver-citas', $data);
    }

    public function login($error = false)
    {
        if ($this->session->logged_in) {
            header("Location:" . base_url() . 'index.php/Cita/ver_citas/');
            exit();
        }

        if (empty($this->input->post())) {
            //Es GET
            $this->load->view('login');
        } else {
            //Es POST
            $codigo = $this->input->post('code');
            $codigo = trim($codigo);
            $clave = '2Kg0BYJr9T';

            //El código es incorrecto
            if ($codigo != $clave) {

                header("Location:" . base_url() . 'index.php/Cita/login/error/true');
                exit();
            }

            $newdata = array(
                'username'  => 'cajauiw',
                'logged_in' => TRUE
            );

            $this->session->set_userdata($newdata);
            header("Location:" . base_url() . 'index.php/Cita/login/ver_citas/');
            exit();
        }
    }

    public function get($id_date = null, $success = FALSE)
    {

        if (is_null($id_date)) {
            exit('No direct script access allowed');
        }

        try {

            $data = array(
                'cita' => $this->Cita_model->get_date($id_date),
                'es_consulta' => $success
            );

            $this->load->view('citas/details', $data);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function crear()
    {
        //Verifica que sea post
        if (empty($this->input->post())) {
            exit('No direct script access allowed');
        }

        try {

            $response = array(
                'codigo' => '100',
                'mensaje' => 'No se pudo crear tu cita'
            );

            //2. Validar data
            if ($this->validate_data()) {

                //3. Insertar datos
                $date_id = $this->Cita_model->insert_cita($this->get_validate_data());
                $response['codigo'] = '200';
                $response['mensaje'] = 'Se creó tu cita';
                $response['id'] = $date_id;
                $this->send_mail($this->get_validate_data());
            }

            echo json_encode($response);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function get_dates($date)
    {
        //Get citas con la fecha que viene como parametro
        $citas = $this->Cita_model->get_dates($date);

        //Con esas citas, Get las horas disponibles para ese dia
        $citas_disponibles = $this->get_availables_dates($citas);

        echo json_encode($citas_disponibles);
        die();
    }

    private function get_availables_dates($citas)
    {
        //Creo un un nuevo arreglo con las horas ocupadas
        $horas_ocupadas = [];
        foreach ($citas as $cita) {
            array_push($horas_ocupadas, $cita->hora_solicitada);
        }

        $horario = [
            '09:30:00', '10:00:00', '10:30:00',
            '11:00:00', '11:30:00', '12:00:00',
            '12:30:00', '13:00:00', '13:30:00',
            '14:00:00', '14:30:00', '15:00:00',
            '15:30:00', '16:00:00'
        ];

        //Obtengo un arreglo con las horas disponibles
        $horas_disponibles = array_diff($horario, $horas_ocupadas);

        return $horas_disponibles;
    }

    private function validate_data()
    {
        $solicitante = trim($this->input->post('solicitante'));
        $mail = trim($this->input->post('correo_solicitante'));

        if (strlen($solicitante) == 0 || strlen($solicitante) > 100) {
            return false;
        }

        if (strlen($mail) == 0 || strlen($mail) > 100) {
            return false;
        }

        return true;
    }

    private function get_validate_data()
    {

        $solicitante = trim($this->input->post('solicitante'));
        $mail = trim($this->input->post('correo_solicitante'));

        $cleaned_data = array(
            'solicitante' => $solicitante,
            'correo_solicitante' => $mail,
            'fecha_solicitada' => $this->input->post('fecha_solicitada'),
            'hora_solicitada' => $this->input->post('hora_solicitada')
        );

        return $cleaned_data;
    }

    private function send_mail($data)
    {
        $this->load->library('email');

        $config['protocol']    = 'smtp';

        $config['smtp_host']    = 'ssl://smtp.gmail.com';

        $config['smtp_port']    = '465';

        $config['smtp_timeout'] = '7';

        $config['smtp_user']    = '';

        $config['smtp_pass']    = '';

        $config['charset']    = 'utf-8';

        $config['newline']    = "\r\n";

        $config['mailtype'] = 'text'; // or html

        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);

        $this->email->from('fernando.vargas@uiwbajio.mx', 'Fernando Vargas');
        $this->email->to('fsnake_arg@hotmail.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        $this->email->send();
    }
}
