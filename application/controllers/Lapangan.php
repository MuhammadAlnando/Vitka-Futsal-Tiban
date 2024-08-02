<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lapangan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Lapangan_model'); // Load model
        $this->load->model('Company_model');
        $this->load->model('Event_model');
       
        $this->load->model('Kategori_model');
        $this->load->model('Kontak_model');

        /* Memanggil function dari masing-masing model yang akan digunakan */
        $this->data['company_data']       = $this->Company_model->get_by_company();
        $this->data['event_sidebar']      = $this->Event_model->get_all_sidebar();
        
        $this->data['kategori_sidebar']   = $this->Kategori_model->get_all();
        $this->data['kontak_sidebar']     = $this->Kontak_model->get_all();
    }

    public function index() {

        $this->data['title'] = "Lapangan";
        $data['lapangan_new'] = $this->Lapangan_model->get_all(); // Ambil data lapangan
        $data = array_merge($data, $this->data); // Gabungkan data

        $this->load->view('front/header', $data);
        $this->load->view('front/navbar', $data);
        $this->load->view('front/lapangan/lapangan_view', $data); // Kirim data ke view
        $this->load->view('front/footer', $data);
    }

    public function detail($id_lapangan) {
        $this->load->model('Lapangan_model');
        $this->data['title'] = "Lapangan Detail";
        
		$this->data['company']    = $this->Company_model->get_by_company();
        $data['lapangan'] = $this->Lapangan_model->get_lapangan_by_id($id_lapangan);
        $data = array_merge($data, $this->data); // Gabungkan data

        $this->load->view('front/header', $data);
        $this->load->view('front/navbar', $data);
       
        $this->load->view('front/lapangan/lapangan_detail', $data);
        $this->load->view('front/footer', $data);
        
      }
}
?>
