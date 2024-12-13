<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Antrian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_antrian', 'm_pasien'));
    }

    public function index()
    {
        $data['title'] = 'Antrian';
        $data['antrian'] = $this->m_antrian->get_daftarpasien_data();
        $data['js'] = 'antrian';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('antrian/antrian.php', $data);
        $this->load->view('templates/footer', $data);
    }

    public function load_data()
    {
        $data['antrian'] = $this->m_antrian->get_daftarpasien_data();
        echo json_encode($data);

    }
    public function load_poli()
    {
        $res['dataPoli'] = $this->m_antrian->get_poli_data();
        $res['dataNIK'] = $this->m_pasien->get_accountpasNIK_data();
        echo json_encode($res);
    }
    public function create()
    {
        $keluhan = $this->input->post('keluhan');
        $poli = $this->input->post('poli');
        $name = $this->input->post('name');
        $Nik = $this->input->post('Nik');
        $daftarpasienDate = date('Y-m-d');

        if ($poli == 1) {
            $prefix = 'PU';
        } elseif ($poli == 2) {
            $prefix = 'PG';
        } elseif ($poli == 3) {
            $prefix = 'PGZ';
        }

        $formattedDate = date('my', strtotime($daftarpasienDate));

        $sql = "SELECT IFNULL(
                    (
                        SELECT CONCAT(?, '/', ?, '/', LPAD(IFNULL(MAX(RIGHT(daftarpasienTrx, 3)) + 1, 1), 3, '0'))
                        FROM daftarpasien
                        WHERE daftarpasienTrx LIKE CONCAT(?, '/', ?, '/%')
                          AND DATE_FORMAT(daftarpasienDate, '%Y%m') = DATE_FORMAT(?, '%Y%m')
                        LIMIT 1
                    ),
                    CONCAT(?, '/', ?, '/001')
                ) AS no_trans;";

        $query = $this->db->query($sql, [$prefix, $formattedDate, $prefix, $formattedDate, $daftarpasienDate, $prefix, $formattedDate]);
        $no_trans = $query->row()->no_trans;

        $sql = "INSERT INTO daftarpasien (daftarpasienTrx, daftarpasienpoliId, daftarpasienKeluhan, daftarpasienDate, daftarpasiennameId,daftarpasienNik)
                VALUES (?, ?, ?, ?, ?, ?)";
        $insert_daftarpasien = $this->db->query($sql, [$no_trans, $poli, $keluhan, $daftarpasienDate, $name, $Nik]);

        if ($insert_daftarpasien) {
            $res['status'] = 'success';
            $res['msg'] = "Data pasien dengan name {$name} berhasil disimpan.";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "Gagal menyimpan data pasien ke daftar.";
        }

        echo json_encode($res);
    }

    public function edit_table()
    {
        $id = $this->input->post('id');
        $sql = $this->db->query("SELECT * FROM daftarpasien WHERE daftarpasienId = ?", array($id));
        $result = $sql->row_array();
        if ($result > 0) {
            $res['status'] = 'ok';
            $res['data'] = $result;
            $res['msg'] = "Data {$id} ada";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "Pasien tidak ditemukan";
        }
        echo json_encode($res);
    }

    public function update_table()
    {
        $id = $this->input->post('id');
        $new_poli = $this->input->post('daftarpasienpoliId');
        $name = $this->input->post('daftarpasiennameId');
        $nik = $this->input->post('daftarpasienNik');
        $keluhan = $this->input->post('daftarpasienKeluhan');
        $current_date = date('Y-m-d');

        $prefix = 'UNKNOWN';
        if ($new_poli == 1)
            $prefix = 'PU';
        elseif ($new_poli == 2)
            $prefix = 'PG';
        elseif ($new_poli == 3)
            $prefix = 'PGZ';

        $formattedDate = date('my', strtotime($current_date));

        $sql = "SELECT IFNULL(
                    (
                        SELECT CONCAT(?, '/', ?, '/', LPAD(IFNULL(MAX(RIGHT(daftarpasienTrx, 3)) + 1, 1), 3, '0'))
                        FROM daftarpasien
                        WHERE daftarpasienTrx LIKE CONCAT(?, '/', ?, '/%')
                          AND DATE_FORMAT(daftarpasienDate, '%Y%m') = DATE_FORMAT(?, '%Y%m')
                        LIMIT 1
                    ),
                    CONCAT(?, '/', ?, '/001')
                ) AS no_trans;";

        $query = $this->db->query($sql, [$prefix, $formattedDate, $prefix, $formattedDate, $current_date, $prefix, $formattedDate]);
        $new_trx = $query->row()->no_trans;

        $daftarpasienData = array(
            'daftarpasienTrx' => $new_trx,
            'daftarpasiennameId' => $name,
            'daftarpasienKeluhan' => $keluhan,
            'daftarpasienpoliId' => $new_poli,
            'daftarpasienNik' => $nik
        );

        $this->db->where('daftarpasienId', $id);
        $update_daftarpasien = $this->db->update('daftarpasien', $daftarpasienData);

        if ($update_daftarpasien) {
            echo json_encode([
                'status' => 'success',
                'msg' => "Data updated successfully"
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'msg' => "Failed to update data."
            ]);
        }
    }

    public function delete_table()
    {
        $id = $this->input->post("id");
        if ($this->m_antrian->delete_table($id)) {
            $res['status'] = 'success';
            $res['msg'] = 'Data Berhasil dihapus';
        } else {
            $res['status'] = 'error';
            $res['msg'] = 'Data Gagagl dihapus';
        }
        echo json_encode($res);
    }

    function exportExcelUmum()
    {
        $sql = "SELECT * FROM daftarpasien  
        join accountpasien on daftarpasienNik = accountpasienId 
        JOIN daftarpoli ON daftarpasienpoliId = daftarpoliId 
        WHERE daftarpasienDelete = 0 AND daftarpasienpoliId = 1
        ORDER BY daftarpasienId DESC;";
        $res['data'] = $this->db->query($sql)->result_array();
        $res['filename'] = 'dataPasienPoliUmum-'.date('Y-m-d_H-i-s');
        $this->load->view("poliumum/v_export_excel", $res);
    }
    function exportExcelGizi()
    {
        $sql = "SELECT * FROM daftarpasien  
        join accountpasien on daftarpasienNik = accountpasienId 
        JOIN daftarpoli ON daftarpasienpoliId = daftarpoliId 
        WHERE daftarpasienDelete = 0 AND daftarpasienpoliId = 3
        ORDER BY daftarpasienId DESC;";
        $res['data'] = $this->db->query($sql)->result_array();
        $res['filename'] = 'dataPasienPoliGizi-'.date('Y-m-d_H-i-s');
        $this->load->view("poligizi/v_export_excel", $res);
    }
    function exportExcelGigi()
    {
        $sql = "SELECT * FROM daftarpasien  
        join accountpasien on daftarpasienNik = accountpasienId 
        JOIN daftarpoli ON daftarpasienpoliId = daftarpoliId 
        WHERE daftarpasienDelete = 0 AND daftarpasienpoliId = 2
        ORDER BY daftarpasienId DESC;";
        $res['data'] = $this->db->query($sql)->result_array();
        $res['filename'] = 'dataPasienPoliGigi-'.date('Y-m-d_H-i-s');
        $this->load->view("poligigi/v_export_excel", $res);
    }

}
?>