<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

class Cart extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model('Bank_model');
		$this->load->model('Cart_model');
		$this->load->model('Company_model');
		$this->load->model('Kontak_model');
		$this->load->model('Jam_model');
		$this->load->model('Transaksi_detail_model');
		$this->load->model('Lapangan_model');

		$this->data['company_data'] 			= $this->Company_model->get_by_company();
		$this->data['kontak'] 						= $this->Kontak_model->get_all();
		$this->data['total_cart_navbar'] 	= $this->Cart_model->total_cart_navbar();

		$this->load->helper('tgl_indo');

		if (!$this->ion_auth->logged_in()) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert">Silahkan login dulu</div>');
			redirect(base_url('auth/login'));
		}
	}

	public function index()
	{
		$this->data['title'] 										= 'Keranjang Belanja';

		$this->data['tanggal'] = array(
			'name'        => 'tanggal[]',
			'id'          => 'tanggal',
			'class' 			=> 'tanggal',
			'required'    => '',
			'autocomplete'    => 'off',
		);
		$this->data['jam_mulai'] = array(
			'name'        => 'jam_mulai[]',
			'id'          => 'jam_mulai',
			'class'       => 'jam_mulai',
			'required'    => '',
		);

		

		// ambil data keranjang
		$this->data['cart_data'] 			  = $this->Cart_model->get_cart_per_customer()->result();
		$this->data['cek_keranjang'] 		= $this->Cart_model->get_cart_per_customer()->row();
		// ambil data customer
		$this->data['customer_data'] 		= $this->Cart_model->get_data_customer();

		$this->load->view('front/cart/body', $this->data);
	}

	public function buy($id)
	{
		// ambil data produk
		$row = $this->Lapangan_model->get_by_id($id);

		// cek id produk
		if ($row) {
			// cek transaksi per user sedang login
			$cek_transaksi 	= $this->Cart_model->cek_transaksi();
			$id_trans 			= $cek_transaksi->id_trans;

			// cek data barang yang dibeli dan masuk ke tabel transaksi_detail
			$notransdet 				= $this->Cart_model->get_notransdet($id);

			// jika transaksi sudah ada
			if ($cek_transaksi) {
				// jika barang yang dibeli sudah ada di cart == update
				if ($notransdet) {
					$this->index();
				}
				// jika barang yang dibeli belum ada di cart == tambahkan
				else {
					$data2 = array(
						'trans_id'    => $id_trans,
						'lapangan_id' => $id,
						'harga_jual'  => $row->harga,
						'total'       => $row->harga,
					);

					$this->Cart_model->insert_detail($data2);

					// set pesan data berhasil dibuat
					$this->session->set_flashdata('message', '<div class="alert" style="background-color: #EB7622; color: white;">Lapangan berhasil ditambahkan</div>');
redirect(site_url('cart'));

				}
			}
			// jika belum ada transaksi
			else {
				// mengambil 1 data terakhir dari tabel untuk pengecekan id_invoice
				$hasil_cek = $this->Cart_model->create_invoiceCode();

				// jika data tidak sama NULL atau tidak kosong atau datanya sudah ada di tabel maka buat id_invoice yang selanjutnya
				if ($hasil_cek != NULL) {
					// mengganti string dengan fungsi substr dari hasil_cek data terakhir
					$kode_akhir = substr($hasil_cek->id_invoice, 10, 6);
					// membuat id_invoice
					$kode2      = str_pad($kode_akhir + 1, 4, '0', STR_PAD_LEFT);
				}
				// jika datanya masih kosong maka buat id_invoice baru
				else {
					$kode2 = "0001";
				}

				// pembuatan tanggal
				$kode1  = date('ymd');
				/*$kode   = "J-".$kode1."-".$kode2;*/
				$kode   = "J-" . $kode1 . "-" . $kode2;

				$data = array(
					'id_invoice'      => $kode,
					'user_id'  				=> $this->session->userdata('user_id'),
					'created_date'    => date('Y-m-d'),
					'created_time'    => date("h:i:s")
				);

				// eksekusi query INSERT
				$this->Cart_model->insert($data);

				$cek_transaksi 	= $this->Cart_model->cek_transaksi();

				$data2 = array(
					'trans_id'  	=> $cek_transaksi->id_trans,
					'lapangan_id' => $id,
					'harga_jual'  => $row->harga,
					'total'  	=> $row->harga,
				);

				$this->Cart_model->insert_detail($data2);

				// set pesan data berhasil dibuat
				$this->session->set_flashdata('message', '<div class="alert" style="background-color: #EB7622; color: white;">Lapangan berhasil ditambahkan</div>');
				redirect(site_url('cart'));
			}
		} else {
			$this->session->set_flashdata('message', '
				<div class="alert alert-block alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
					<i class="ace-icon fa fa-bullhorn green"></i> Data tidak ditemukan
				</div>');
			redirect(base_url());
		}
	}

	public function delete($id)
{
    $id = $this->uri->segment(3); // Mengambil ID dari URI segment

    // Mengambil data item keranjang berdasarkan ID
    $row = $this->Cart_model->get_by_id_detail($id);

    if ($row) {
        $id_transdet = $row->id_transdet;

        // Menghapus item dari database
        $this->Cart_model->delete($id_transdet);

        // Menampilkan pesan berhasil
        $this->session->set_flashdata('message', '<div class="alert" style="background-color: #EB7622; color: white;">Sewa Anda Berhasil dihapus</div>');
        redirect(site_url('cart'));
    } else {
        // Menampilkan pesan jika data tidak ditemukan
        $this->session->set_flashdata('message', '<div class="alert alert-warning alert">Sewa tidak ditemukan</div>');
        redirect(site_url('cart'));
    }
}


	public function empty_cart($id_trans)
	{
		$id_trans = $this->uri->segment(3);

		$this->Cart_model->kosongkan_keranjang($id_trans);

		$this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><i class="ace-icon fa fa-bullhorn green"></i> Keranjang Anda telah dikosongkan</div>');

		redirect(site_url('cart'));
	}

	public function checkout()
{
    $lapangan = $this->input->post('lapangan'); // Sesuaikan dengan nama input yang benar

    $count = count($lapangan);
    for ($i = 0; $i < $count; $i++) {
        // Ambil nilai jam_mulai, durasi, harga_siang, dan harga_malam
        $jam_mulai = $this->input->post('jam_mulai[' . $i . ']');
        $durasi = $this->input->post('durasi[' . $i . ']');
        $harga_siang = $this->input->post('harga_siang[' . $i . ']');
        $harga_malam = $this->input->post('harga_malam[' . $i . ']');

        // Terapkan diskon 50% pada harga siang
        $harga_siang = $harga_siang * 0.5;

        // Inisialisasi total harga siang dan malam
        $total_harga_siang = 0;
        $total_harga_malam = 0;

        // Hitung durasi dalam harga siang dan harga malam
        for ($j = 0; $j < $durasi; $j++) {
            $jam_current = date('H:i:s', strtotime($jam_mulai . ' + ' . $j . ' hours'));

            if ($jam_current >= '17:00:00' && $jam_current < '18:00:00') {
                // Perhitungan spesifik untuk jam 17:00 - 18:00
                $total_harga_siang += $harga_siang;
            } elseif ($jam_current >= '18:00:00' && $jam_current < '22:00:00') {
                $total_harga_malam += $harga_malam;
            } elseif ($jam_current >= '07:00:00' && $jam_current < '17:00:00') {
                $total_harga_siang += $harga_siang;
            }
        }

        $total_harga = $total_harga_siang + $total_harga_malam;

        $data_detail[$i] = array(
            'id_transdet'   => $this->input->post('id_transdet[' . $i . ']'),
            'tanggal'       => $this->input->post('tanggal[' . $i . ']'),
            'jam_mulai'     => $jam_mulai,
            'durasi'        => $durasi,
            'harga_jual'    => $total_harga,
            'harga_siang'   => $total_harga_siang,
            'harga_malam'   => $total_harga_malam,
            'jam_selesai'   => date('H:i:s', strtotime($jam_mulai . ' + ' . $durasi . ' hours')),
            'total'         => $total_harga,
        );

        // Update transaksi_detail sesuai dengan $data_detail
        $this->db->update_batch('transaksi_detail', $data_detail, 'id_transdet');
    }

    // Hitung subtotal
    $this->db->select_sum('total');
    $this->db->join('transaksi_detail', 'transaksi.id_trans = transaksi_detail.trans_id');
    $this->db->where('id_trans', $this->input->post('id_trans'));
    $this->db->where('user_id', $this->session->userdata('user_id'));
    $query = $this->db->get('transaksi')->row();
    $subtotal = $query->total;

    // Update grand total dan data transaksi lainnya
    $this->db->where('id_trans', $this->input->post('id_trans'));
    $this->db->where('user_id', $this->session->userdata('user_id'));
    $this->db->update('transaksi', array(
        'subtotal'      => $subtotal,
        'grand_total'   => $subtotal,
        'deadline'      => date('Y-m-d H:i:s', strtotime('+1 hour')),
        'catatan'       => $this->input->post('catatan'),
        'status'        => '1',
    ));

    redirect(site_url('cart/finished'));
}




	public function finished()
	{
		$this->data['title'] 							= 'Transaksi Selesai';

		$this->data['cart_latest']	    				= $this->Cart_model->get_cart_per_customer_latest();
		$this->data['cart_finished']	    			= $this->Cart_model->get_cart_per_customer_finished($this->data['cart_latest']->id_trans)->result();
		$this->data['cart_finished_row']   			= $this->Cart_model->get_cart_per_customer_finished($this->data['cart_latest']->id_trans)->row();
		$this->data['data_bank'] 								= $this->Bank_model->get_all();

		$this->load->view('front/cart/finished', $this->data);
	}

	public function download_invoice($id)
	{
		$row 						= $this->Cart_model->get_by_id($id);

		if ($this->session->userdata('user_id') != $row->user_id) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert">Invoice tidak ditemukan</div>');
			redirect(site_url('cart/history'));
		}

		if ($row) {
			ob_start();

			$this->data['cart_finished']	    			= $this->Cart_model->get_cart_per_customer_finished($id)->result();
			$this->data['cart_finished_row']   			= $this->Cart_model->get_cart_per_customer_finished($id)->row();

			$this->data['data_bank'] 								= $this->Bank_model->get_all();

			$this->load->view('front/cart/download_invoice', $this->data);

			$html = ob_get_contents();
			$html = '<title style="font-family: freeserif">' . nl2br($html) . '</title>';
			ob_end_clean();

			$pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8', array(10, 0, 10, 0));
			$pdf->setDefaultFont('Arial');
			$pdf->setTestTdInOnePage(false);
			$pdf->WriteHTML($html);
			$pdf->Output('download_invoice.pdf');
		} else {
			$this->session->set_flashdata('message', "<script>alert('Data tidak ditemukan');</script>");
			redirect(site_url());
		}
	}

	public function history()
	{
		$this->data['title'] 							= 'Daftar Transaksi';
		$this->data['cek_cart_history']	  = $this->Cart_model->cart_history()->row();
		$this->data['cart_history']	    	= $this->Cart_model->cart_history()->result();

		$this->load->view('front/cart/history', $this->data);
	}

	public function history_detail($id)
	{
		$row 						= $this->Cart_model->get_by_id($id);

		if ($this->session->userdata('user_id') != $row->user_id) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert">Invoice tidak ditemukan</div>');
			redirect(site_url('cart/history'));
		} else {
			$this->data['title'] 								= 'Detail Riwayat Transaksi';

			$this->data['history_detail']	    	= $this->Cart_model->history_detail($id)->result();
			$this->data['history_detail_row']		= $this->Cart_model->history_detail($id)->row();
			$this->data['data_bank'] 								= $this->Bank_model->get_all();

			$this->load->view('front/cart/history_detail', $this->data);
		}
	}

	public function getJamMulai()
	{
		$tanggal = $this->input->post('tanggal');
		$lapangan_id = $this->input->post('lapangan_id');

		if ($tanggal === FALSE || $lapangan_id === FALSE) {
			echo json_encode(array());
			die();
		}

		$list_jam_mulai_terpakai = $this->Transaksi_detail_model->get_jam_mulai_terpakai($tanggal, $lapangan_id);

		$list_jam_mulai_terpakai_arr = array();
		foreach ($list_jam_mulai_terpakai as $a_jam) {

			if (intval($a_jam->durasi) > 1) {
				$list_jam_range = $this->Jam_model->get_jam_range($a_jam->jam_mulai, $a_jam->jam_selesai);
				foreach ($list_jam_range as $a_jam_from_range) {
					if (!in_array($a_jam_from_range->jam, $list_jam_mulai_terpakai_arr))
						array_push($list_jam_mulai_terpakai_arr, $a_jam_from_range->jam);
				}
			} else {
				if (!in_array($a_jam->jam_mulai, $list_jam_mulai_terpakai_arr))
					array_push($list_jam_mulai_terpakai_arr, $a_jam->jam_mulai);
			}
		}

		$list_jam = $this->Jam_model->get();

		$list_jam_arr = array();
		foreach ($list_jam as $a_jam) {
			array_push($list_jam_arr, $a_jam->jam);
		}

		$result = array();

		foreach ($list_jam_arr as $a_jam) {
			if (!in_array($a_jam, $list_jam_mulai_terpakai_arr)) {
				$a_jam_row = new stdClass();
				$a_jam_row->durasi = '1';
				$a_jam_row->jam_mulai = $a_jam;

				array_push($result, $a_jam_row);
			}
		}

		echo json_encode($result);
	}

	public function upload_bukti($id_trans) {
        // Konfigurasi upload file
        $config['upload_path']   = './assets/images/transaksi/';
        $config['allowed_types'] = 'gif|jpeg|jpg|png|pdf';
        $config['max_size']      = 2048; // Ukuran maksimum file (2MB)
        $config['overwrite']     = TRUE; // Timpa file jika sudah ada dengan nama yang sama
    
        $this->load->library('upload', $config);
    
        if (!$this->upload->do_upload('bukti_pembayaran')) {
            // Jika gagal upload
            $error = array('error' => $this->upload->display_errors());
            // Tampilkan pesan error jika diperlukan
            $this->session->set_flashdata('message', $error['error']);
            $this->session->set_flashdata('message_type', 'error');
        } else {
            // Jika berhasil upload
            $upload_data = $this->upload->data();
            // Simpan nama file ke dalam database atau sesuai kebutuhan Anda
            $data = array(
                'bukti_pembayaran' => $upload_data['file_name'],
                'status' => 5 // Update status menjadi "menunggu konfirmasi"
            );
            $this->db->where('id_trans', $id_trans);
            $this->db->update('transaksi', $data);
            
            // Tampilkan pesan sukses jika diperlukan
            $this->session->set_flashdata('message', 'Bukti pembayaran berhasil diupload, menunggu konfirmasi.');
            $this->session->set_flashdata('message_type', 'success');
        }
    
        // Redirect kembali ke halaman riwayat transaksi
        redirect('cart/history');
    }

	// Method untuk membatalkan transaksi
	public function cancel($id_trans) {
        $transaction = $this->Transaksi_detail_model->get_transaction($id_trans);

        if ($transaction->status == '2' || $transaction->status == '5') {
            $this->session->set_flashdata('message', 'Transaksi yang sudah lunas atau menunggu konfirmasi tidak bisa dibatalkan');
            $this->session->set_flashdata('message_type', 'error');
            redirect('cart/history');
        } else {
            $result = $this->Transaksi_detail_model->cancel_transaction($id_trans);
            if ($result) {
                $this->session->set_flashdata('message', 'Transaksi berhasil dibatalkan');
                $this->session->set_flashdata('message_type', 'success');
            } else {
                $this->session->set_flashdata('message', 'Transaksi gagal dibatalkan');
                $this->session->set_flashdata('message_type', 'error');
            }
            redirect('cart/history');
        }
    }
	
	
	
}