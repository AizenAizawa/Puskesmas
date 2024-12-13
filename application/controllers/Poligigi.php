<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poligigi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_antrian');
    }

    public function index()
    {
        $data['title'] = 'Poligigi';
        $data['poligigi'] = $this->m_antrian->get_poligigi_data();
        $data['js'] = 'poligigi';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('poligigi/poligigi.php', $data);
        $this->load->view('templates/footer', $data);
    }

    public function load_data()
    {
        $data['poligigi'] = $this->m_antrian->get_poligigi_data();
        echo json_encode($data);
    }

    public function active() {
        $id = $this->input->post("id");
        $status = $this->input->post("status");
        if ($this->m_antrian->active_dataPoligigi($id)) {
            $res["status"] = "success";
            $ket=($status == 1)? "Nonaktif" : "Aktif";
            $res["msg"] = "Data berhasil ". $ket;
        } else {
            $res["status"] = "error";
            $ket=($status == 1)? "Nonaktif" : "Aktif";
            $res["msg"] = "Data Gagal ". $ket;
        }
        echo json_encode($res);
    }

}
?>