<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cita_model extends CI_Model  {

    public function get_all_dates()
    {
        $query = $this->db->get('cita');
        return $query->result();
    }

    public function get_date($id)
    {
        $limit = 1;
        $query = $this->db->get_where('cita', array('id_cita' => $id), $limit);
        return $query->result();
    }

    public function get_dates($date)
    {
        $query = $this->db->get_where('cita', array('fecha_solicitada' => $date));
        return $query->result();
    }

    public function get_festive_dates()
    {
        $query = $this->db->get('dias_festivos');
        return $query->result();
    }

    public function insert_cita($data)
    {    
        $this->db->insert('cita', $data);
        $date_id = $this->db->insert_id();
        return $date_id;
    }
}