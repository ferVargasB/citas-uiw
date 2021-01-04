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
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules(
            'solicitante', 'Solicitante', 
            'required|min_length[15]|max_length[50]',
            array('required' => "El nombre de la persona no debe exceder los 50 caracteres y debe tener más de 15")
        );
        $this->form_validation->set_rules(
            'correo_solicitante', 
            'Email', 'required|valid_email|min_length[15]|max_length[50]',
            array(
                'required' => 'El correo  no debe exceder los 50 caracteres y debe tener más de 15',
            )
        );
        $this->form_validation->set_rules(
            'fecha_solicitada', 
            'fecha solicitada', 
            'callback_fecha_check|required',
            array(
                'required' => 'Debes selecionar un día para tu cita',
                'fecha_check' => "La {field} no es valida",
            )
        );
            
        $this->form_validation->set_rules('hora_solicitada', 'Hora solicitada', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $data = array(
                'title' => 'Citas'
            );
            $this->load->view('templates/head', $data);
            $this->load->view('citas/create-form');
            $this->load->view('templates/footer');
        }
        else
        {
            echo var_dump($this->input->post());
        }
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
            'fecha' => $fecha_hoy,
            'title' => 'Citas para hoy'
        );
        $this->load->view('templates/head', $data);
        $this->load->view('citas/ver-citas', $data);
        $this->load->view('templates/footer', $data);
        
    }

    //Interfaz de Lidia
    public function cuentas_ver_citas()
    {
        if (!$this->session->logged_in) {
            header("Location:" . base_url() . 'index.php/Cita/login/');
            exit();
        }

        //Obtengo las citas para hoy
        $fecha_hoy = date('Y-m-d');
        $data = array(
            'citas' => $this->Cita_model->get_all_dates(),
            'fecha' => $fecha_hoy,
            'title' => 'Citas para hoy:',
            'css_table' => base_url().'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
            'css_responisve' => base_url().'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
            'jquery_data' => base_url().'assets/plugins/datatables/jquery.dataTables.min.js',
            'bootstrap_data' => base_url().'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
            'data_responsive' => base_url().'assets/plugins/datatables-responsive/js/dataTables.responsive.min.js',
            'data_responsive4' => base_url().'plugins/datatables-responsive/js/responsive.bootstrap4.min.js'
        );
        $this->load->view('templates/head', $data);
        $this->load->view('citas/ver-citas-cuentas', $data);
        $this->load->view('templates/footer', $data);
        
    }

    public function login($error = 0)
    {
        if ($this->session->logged_in) {
            header("Location:" . base_url() . 'index.php/Cita/ver_citas/');
            exit();
        }

        if (empty($this->input->post())) {

            $data = array(
                'title' => 'Login citas',
                'error' => $error
            );
            $this->load->view('templates/head', $data);
            $this->load->view('login');
            
        } else {
            //Es POST
            $codigo = $this->input->post('code');
            $codigo = trim($codigo);
            $clave = "2Kg0BYJr9T";
            $clave_lidia = "JNoW2y50On";

            //El código es incorrecto
            if ($codigo != $clave && $codigo != $clave_lidia) {

                header("Location:" . base_url() . 'index.php/Cita/login/error/1');
                exit();
            }


            //Si clave es caja
            if ($codigo == $clave){
                $newdata = array(
                    'username'  => 'cajauiw',
                    'logged_in' => TRUE,
                    'ruta' => 'index.php/Cita/ver_citas/'
                );
            }

            //Si clave es cuentas
            if ($codigo == $clave_lidia){
                $newdata = array(
                    'username'  => 'cuentas',
                    'logged_in' => TRUE,
                    'ruta' => 'index.php/Cita/cuentas_ver_citas/'
                );
            }

            echo var_dump($newdata);

            $this->session->set_userdata($newdata);
            header("Location:" . base_url() . $newdata['ruta']);
            exit();
        }
    }

    public function logout()
    {
        if ($this->session->logged_in) {
            $this->session->sess_destroy();
            header("Location:" . base_url() . 'index.php/Cita/login/success_destroy');
            exit();
        }

        header("Location:" . base_url() . 'index.php/Cita/login/');
        exit();
    }

    public function get($id_date = null, $success = FALSE)
    {

        if (is_null($id_date)) {
            exit('No direct script access allowed');
        }

        try {

            $data = array(
                'cita' => $this->Cita_model->get_date($id_date),
                'es_consulta' => $success,
                'title' => 'Detalles cita'
            );

            $this->load->view('templates/head', $data);
            $this->load->view('citas/details', $data);
            $this->load->view('templates/footer', $data);

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

    public function get_festive_dates()
    {
        //Get citas con la fecha que viene como parametro
        $citas = $this->Cita_model->get_festive_dates();

        echo json_encode($citas);
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

    public function fecha_check($date)
    {
        $festivos = $this->Cita_model->get_festive_dates();

         foreach($festivos as $festivo){
            if ($date == $festivo->dia){
                return FALSE;
            }
        }

        return TRUE;
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
        $this->email->to( $data['correo_solicitante'] );

        $this->email->subject('Horario para realizar su pago en UIW Bajío');
        $this->email->message('Hola '.$data['solicitante']."\r\n".
                                'Su cita para realizar su pago en caja está programado para el día: '.
                                date("d-m-Y", strtotime($data['fecha_solicitada']) ).' en la hora: '.$data['hora_solicitada']."\r\n");

        $this->email->send();
    }
}
