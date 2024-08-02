<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load library database CodeIgniter di konstruktor
        $this->load->database();
    }

    public function save($data) {
        // Simpan data pesan ke dalam tabel 'pesan'
        $this->db->insert('pesan', $data);

        // Kembalikan ID dari data yang baru saja disimpan
        return $this->db->insert_id();
    }


    /**
     * Simpan pesan baru ke dalam database.
     * 
     * @param array $data Data pesan yang akan disimpan
     * @return int ID dari pesan yang baru saja disimpan
     */
    public function save_pesan($data) {
        $this->db->insert('pesan', $data);
        return $this->db->insert_id(); // Mengembalikan ID pesan yang baru saja disimpan
    }

    /**
     * Ambil semua pesan yang ada dari database.
     * 
     * @return array Array berisi data semua pesan
     */
    public function get_all_pesan() {
        $query = $this->db->get('pesan');
        return $query->result_array();
    }

    /**
     * Ambil detail pesan berdasarkan ID.
     * 
     * @param int $id ID dari pesan yang akan diambil
     * @return array Data pesan dalam bentuk array
     */
    public function get_pesan_by_id($id) {
        $query = $this->db->get_where('pesan', array('id' => $id));
        return $query->row_array();
    }

    public function get_all()
    {
        return $this->db->get('pesan')->result_array();
    }

    /**
     * Hapus pesan berdasarkan ID.
     * 
     * @param int $id ID dari pesan yang akan dihapus
     */
    public function delete_pesan($id) {
        $this->db->delete('pesan', array('id' => $id));
    }

    // Fungsi tambahan bisa ditambahkan sesuai kebutuhan
    public function total_rows() {
        $this->db->from('pesan'); // Ganti 'pesan' dengan nama tabel yang sesuai
        return $this->db->count_all_results();
    }
}
