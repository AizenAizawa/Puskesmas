<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load the database if not loaded globally
        $this->load->database();  // Ensures database connection is available
    }

    // Method to get the total number of patients
    public function get_total_pasien() {
        $this->db->select('COUNT(*) as total_pasien');
        $this->db->from('accountpasien');
        $query = $this->db->get();
        return $query->row()->total_pasien;
    }

    // Method to get the number of patients by a specific poli (department)
    public function get_pasien_poli($poli_id) {
        $this->db->select('COUNT(*) as total_pasien');
        $this->db->from('daftarpasien');
        $this->db->where('daftarpasienpoliId', $poli_id); // Assuming daftarpasienpoliId is the column for poli ID
        $query = $this->db->get();
        return $query->row()->total_pasien;
    }

}

