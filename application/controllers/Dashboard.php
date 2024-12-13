<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_dashboard');
    }

    public function index()
    {
        $data['title'] = 'dashboard';
        $data['js'] = 'dashboard';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer', $data);
    }

    public function pasien() {
        $total_pasien = $this->m_dashboard->get_total_pasien();
        $poli_umum = $this->m_dashboard->get_pasien_poli(1); // Poli Umum
        $poli_gigi = $this->m_dashboard->get_pasien_poli(2); // Poli Gigi
        $poli_gizi = $this->m_dashboard->get_pasien_poli(3); // Poli Gizi
    
        $data = array(
            'total_pasien' => $total_pasien,
            'poli_umum' => $poli_umum,
            'poli_gigi' => $poli_gigi,
            'poli_gizi' => $poli_gizi,
        );
    
        echo json_encode($data);
    }
    


}
?>