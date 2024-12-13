<?php
class M_pasien extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_bank($data) {
        return $this->db->insert('bank', $data);
    }

    public function get_accountpasien_data() {
        $sql = "SELECT * FROM accountpasien 
        
        JOIN gender ON accountpasienGender = genderId 
        WHERE accountpasienDelete = 0 order by accountpasienId desc; ";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function get_gender_data() {
        $sql = "SELECT * FROM gender order by genderId desc; ";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    public function get_golongan_data() {
        $sql = "SELECT * FROM golongandarah order by golongandarahId desc; ";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function get_accountpasNIK_data()
    {
        $this->db->select('accountpasienId, accountpasienNik, accountpasienName');
        $this->db->from('accountpasien');
        $this->db->where('accountpasienDelete', 0);
        $query = $this->db->get();

        return $query->result();
    }
    
    public function delete_table($id) {
        $sql = "UPDATE accountpasien SET accountpasienDelete = 1 WHERE accountpasienId = '$id'";
        return $this->db->query($sql, array($id));
    }
}
?>