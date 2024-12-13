<?php
class M_antrian extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_daftarpasien_data() {
        $sql = "SELECT * FROM daftarpasien  
        join accountpasien on daftarpasienNik = accountpasienId 
        JOIN daftarpoli ON daftarpasienpoliId = daftarpoliId 
        WHERE daftarpasienDelete = 0 order by daftarpasienId desc; ";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    public function get_poliumum_data() {
        $sql = "SELECT * FROM daftarpasien  
                join accountpasien on daftarpasienNik = accountpasienId 
                JOIN daftarpoli ON daftarpasienpoliId = daftarpoliId 
                WHERE daftarpasienDelete = 0 AND daftarpasienpoliId = 1
                ORDER BY daftarpasienId DESC;";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    public function get_poligigi_data() {
        $sql = "SELECT * FROM daftarpasien  
                join accountpasien on daftarpasienNik = accountpasienId 
                JOIN daftarpoli ON daftarpasienpoliId = daftarpoliId 
                WHERE daftarpasienDelete = 0 AND daftarpasienpoliId = 2
                ORDER BY daftarpasienId DESC;";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    public function get_poligizi_data() {
        $sql = "SELECT * FROM daftarpasien  
                join accountpasien on daftarpasienNik = accountpasienId 
                JOIN daftarpoli ON daftarpasienpoliId = daftarpoliId 
                WHERE daftarpasienDelete = 0 AND daftarpasienpoliId = 3
                ORDER BY daftarpasienId DESC;";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    public function get_poli_data() {
        $sql = "SELECT * FROM daftarpoli order by daftarpoliId desc; ";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    public function delete_table($id) {
        $sql = "UPDATE accountpasien SET accountpasienDelete = 1 WHERE daftarpasienId = '$id'";
        return $this->db->query($sql, array($id));
    }

    public function active_dataPoligigi($id) {
        $sql = "UPDATE daftarpasien SET daftarpasienStatus = if(daftarpasienStatus = 1, 0, 1) WHERE daftarpasienId='$id'";
        return $this->db->query($sql);
    }
    public function active_dataPoligizi($id) {
        $sql = "UPDATE daftarpasien SET daftarpasienStatus = if(daftarpasienStatus = 1, 0, 1) WHERE daftarpasienId='$id'";
        return $this->db->query($sql);
    }
    public function active_dataPoliumum($id) {
        $sql = "UPDATE daftarpasien SET daftarpasienStatus = if(daftarpasienStatus = 1, 0, 1) WHERE daftarpasienId='$id'";
        return $this->db->query($sql);
    }

}
?>