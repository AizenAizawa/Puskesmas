<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pasien');
    }

    public function index()
    {
        $data['title'] = 'Pasien';
        $data['pasien'] = $this->m_pasien->get_accountpasien_data();
        $data['js'] = 'pasien';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pasien/pasien.php', $data);
        $this->load->view('templates/footer', $data);
    }

    public function load_data()
    {
        $data['pasien'] = $this->m_pasien->get_accountpasien_data();
        echo json_encode($data);

    }

    public function load_gender()
    {
        $res['dataGender'] = $this->m_pasien->get_gender_data();
        $res['dataGolongan'] = $this->m_pasien->get_golongan_data();
        echo json_encode($res);
    }

    public function create()
    {
        $nik = $this->input->post('nik');
        if (!empty($nik)) {
            $nama = $this->input->post('nama');
            $jenisKelamin = $this->input->post('jenisKelamin');
            $golongandarah = $this->input->post('golongandarah');
            $usia = $this->input->post('usia');
            $alamat = $this->input->post('alamat');
            $tanggalLahir = $this->input->post('tanggalLahir');
            $query = $this->db->query("SELECT COUNT(*) as count FROM accountpasien WHERE accountpasienNIK = ?", [$nik]);
            $result = $query->row();

            if ($result->count > 0) {
                $res['status'] = 'error';
                $res['msg'] = "NIK {$nik} sudah terdaftar.";
            } else {
                $sql = "INSERT INTO accountpasien (accountpasienNIK, accountpasienName, accountpasienGender, accountpasienGolongan, accountpasienUsia, accountpasienAlamat, accountpasienLahir)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
                $exc = $this->db->query($sql, [$nik, $nama, $jenisKelamin, $golongandarah, $usia, $alamat, $tanggalLahir]);

                if ($exc) {
                    $res['status'] = 'success';
                    $res['msg'] = "Data pasien dengan nama {$nama} berhasil disimpan.";
                } else {
                    $res['status'] = 'error';
                    $res['msg'] = "Gagal menyimpan data pasien.";
                }
            }
            echo json_encode($res);
        } else {
            $res['status'] = 'error';
            $res['msg'] = "NIK tidak boleh kosong.";
            echo json_encode($res);
        }
    }

    public function edit_table()
    {
        $id = $this->input->post('id');
        $sql = $this->db->query("SELECT * FROM accountpasien WHERE accountpasienId = ?", array($id));
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

        $accountpasienData = array(
            'accountpasienName' => $this->input->post('accountpasienName'),
            'accountpasienNik' => $this->input->post('accountpasienNik'),
            'accountpasienGender' => $this->input->post('accountpasienGender'),
            'accountpasienGolongan' => $this->input->post('accountpasienGolongan'),
            'accountpasienUsia' => $this->input->post('accountpasienUsia'),
            'accountpasienAlamat' => $this->input->post('accountpasienAlamat'),
            'accountpasienLahir' => $this->input->post('accountpasienLahir'),
        );

        $nik = $this->input->post('accountpasienNik');
        $query = $this->db->get_where('accountpasien', array('accountpasienNik' => $nik, 'accountpasienId !=' => $id));

        $res = array();

        if ($query->num_rows() > 0) {
            $res['status'] = 'error';
            $res['msg'] = "NIK sudah digunakan oleh data lain";
        } else {
            $this->db->where('accountpasienId', $id);
            $update_accountpasien = $this->db->update('accountpasien', $accountpasienData);

            if ($update_accountpasien) {
                $res['status'] = 'success';
                $res['msg'] = "Data updated successfully";
            } else {
                $res['status'] = 'error';
                $res['msg'] = "Failed to update data";
            }
        }

        echo json_encode($res);
    }

    public function delete_table()
    {
        $id = $this->input->post("id");
        if ($this->m_pasien->delete_table($id)) {
            $res['status'] = 'success';
            $res['msg'] = 'Data Berhasil dihapus';
        } else {
            $res['status'] = 'error';
            $res['msg'] = 'Data Gagagl dihapus';
        }
        echo json_encode($res);
    }

}
?>