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

}
