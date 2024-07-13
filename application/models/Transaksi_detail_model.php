<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi_detail_model extends CI_Model{

	function get_jam_mulai_terpakai($tanggal, $lapangan_id){
		$this->db->select('jam_mulai, durasi, jam_selesai');
		$this->db->where('tanggal', $tanggal);
		$this->db->where('lapangan_id', $lapangan_id);
		return $query = $this->db->get('transaksi_detail')->result();

		// $sql = "
		// 		SELECT
		// 			jam_mulai, durasi, jam_selesai
		// 		FROM futsal_transaksi_detail
		// 		where
		// 			tanggal = ? and lapangan_id = ?
		// 		";
		// $query = $this->db->query($sql, array($tanggal, $lapangan_id));
		//
		// return $query->result();
	}

	public function update_transaksi($id_trans, $data) {
        $this->db->where('id_trans', $id_trans);
        $this->db->update('transaksi', $data);
    }

	public function get_all_transaksi() {
        $this->db->select('transaksi.id_trans, transaksi.id_invoice, users.name, transaksi.created_date, transaksi.grand_total, transaksi.status, transaksi.bukti_pembayaran');
        $this->db->from('transaksi');
        $this->db->join('users', 'transaksi.user_id = users.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function update_bukti_pembayaran($id_trans, $bukti_pembayaran) {
        $data = array(
            'bukti_pembayaran' => $bukti_pembayaran
        );
        $this->db->where('id_trans', $id_trans);
        $this->db->update('transaksi', $data);
    }

    

    public function get_by_transaksi_id($trans_id)
{
    $this->db->where('trans_id', $trans_id);
    $query = $this->db->get('transaksi_detail'); // Nama tabel transaksi_detail
    
    // Debugging
    echo $this->db->last_query(); // Ini akan menampilkan query SQL yang terakhir dieksekusi
    
    return $query->result();
}





    public function update_status($id_trans, $status) {
        $data = array(
            'status' => $status
        );
        $this->db->where('id_trans', $id_trans);
        $this->db->update('transaksi', $data);
    }

    public function get_transaction($id_trans) {
        $this->db->where('id_trans', $id_trans);
        return $this->db->get('transaksi')->row();
    }

    // Membatalkan transaksi
    public function cancel_transaction($id_trans) {
        $this->db->where('id_trans', $id_trans);
        return $this->db->delete('transaksi');
    }


    public function get_cart_history() {
        // Query untuk mendapatkan riwayat transaksi
        $this->db->order_by('created_date', 'desc');
        return $this->db->get('transaksi')->result();
    }

    public function cek_cart_history() {
        // Query untuk memeriksa riwayat transaksi
        $this->db->select('id_trans');
        $this->db->from('transaksi');
        return $this->db->get()->row();
    }

    public function get_history_detail($id_trans) {
        // Query untuk mendapatkan detail riwayat transaksi
        $this->db->where('id_trans', $id_trans);
        return $this->db->get('transaksi')->row();
    }

}
