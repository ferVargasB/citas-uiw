<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cita_model extends CI_Model  {

    public function get_all_dates()
    {
        $query = $this->db->get('cita');
        return $query->result();
    }

    public function get_dates($date)
    {
        $query = $this->db->get_where('cita', array('fecha_solicitada' => $date));
        return $query->result();
    }

    public function insert_cita($data)
    {    
        $this->db->insert('cita', $data);
    }
}