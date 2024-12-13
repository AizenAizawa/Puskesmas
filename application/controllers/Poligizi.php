<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poligizi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_antrian');
    }

    public function index()
    {
        $data['title'] = 'Poligizi';
        $data['poligizi'] = $this->m_antrian->get_poligizi_data();
        $data['js'] = 'poligizi';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('poligizi/poligizi.php', $data);
        $this->load->view('templates/footer', $data);
    }

    public function load_data()
    {
        $data['poligizi'] = $this->m_antrian->get_poligizi_data();
        echo json_encode($data);
    }

    public function active() {
        $id = $this->input->post("id");
        $status = $this->input->post("status");
        if ($this->m_antrian->active_dataPoligizi($id)) {
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