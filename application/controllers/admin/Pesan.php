<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model, library, helper if needed
        $this->load->model('pesan_model'); // Load pesan_model jika diperlukan
    }

    public function save() {
        // Validasi form
        $this->form_validation->set_rules('nama_pengirim', 'Nama Pengirim', 'required');
        $this->form_validation->set_rules('subjek', 'Subjek', 'required');
        $this->form_validation->set_rules('pesan', 'Isi Pesan', 'required');

        if ($this->form_validation->run() === FALSE) {
            $response['success'] = false;
            $response['message'] = validation_errors();
        } else {
            // Proses simpan pesan ke database
            $data = array(
                'nama_pengirim' => $this->input->post('nama_pengirim'),
                'subjek' => $this->input->post('subjek'),
                'pesan' => $this->input->post('pesan'),
                'tanggal' => date('Y-m-d H:i:s') // Tambahkan tanggal saat ini
                // Tambahkan field lain sesuai kebutuhan Anda
            );

            // Simpan data ke dalam database menggunakan model
            $insert_id = $this->pesan_model->save($data);

            if ($insert_id) {
                $response['success'] = true;
                $response['message'] = 'Pesan berhasil terkirim.';
            } else {
                $response['success'] = false;
                $response['message'] = 'Gagal mengirim pesan. Silakan coba lagi.';
            }
        }

        // Return respons dalam bentuk JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function index() {
        $data['pesan_list'] = $this->pesan_model->get_all_pesan();
        $this->load->view('back/pesan/pesan_list', $data);
    }

    public function view($id) {
        $data['title'] = 'Detail Pesan';
        $data['pesan_detail'] = $this->pesan_model->get_pesan_by_id($id);
        $this->load->view('back/pesan/pesan_view', $data);
    }
    
    public function delete($id) {
        // Lakukan penghapusan pesan berdasarkan $id
        $this->pesan_model->delete_pesan($id);
        redirect('admin/pesan'); // Redirect kembali ke halaman daftar pesan setelah penghapusan
    }
    
}
?>
