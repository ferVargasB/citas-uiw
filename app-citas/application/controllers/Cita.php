<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cita extends CI_Controller {
    
    public function __construct()
    {
            parent::__construct();
            // Your own constructor code
            $this->load->model('Cita_model');
    }

	public function index()
	{
        $citas = $this->Cita_model->get_all_dates();
		echo json_encode($citas);
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
        foreach( $citas as $cita ){
            array_push($horas_ocupadas, $cita->hora_solicitada);
        }

        $horario = ['09:30:00', '10:00:00', '10:30:00',
                                '11:00:00', '11:30:00', '12:00:00',
                                '12:30:00', '13:00:00', '13:30:00',
                                '14:00:00', '14:30:00', '15:00:00',
                                '15:30:00','16:00:00'];

        //Obtengo un arreglo con las horas disponibles
        $horas_disponibles = array_diff($horario, $horas_ocupadas);

        return $horas_disponibles;
    }
}
