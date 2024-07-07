<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pesan_model'); // Pastikan model di-load dengan nama yang benar
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    public function save() {
        $this->form_validation->set_rules('nama_pengirim', 'Nama Pengirim', 'required');
        $this->form_validation->set_rules('subjek', 'Subjek', 'required');
        $this->form_validation->set_rules('pesan', 'Isi Pesan', 'required');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array('success' => false, 'message' => validation_errors()));
        } else {
            $config['upload_path'] = './assets/images/pesan/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config['max_size'] = 2048; // 2MB
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('userfile')) {
                echo json_encode(array('success' => false, 'message' => $this->upload->display_errors()));
            } else {
                $fileData = $this->upload->data();
                $data = array(
                    'nama_pengirim' => $this->input->post('nama_pengirim'),
                    'subjek' => $this->input->post('subjek'),
                    'pesan' => $this->input->post('pesan'),
                    'lampiran' => $fileData['file_name'],
                    'tanggal' => date('Y-m-d H:i:s')
                );

                $insert_id = $this->Pesan_model->save($data);

                if ($insert_id) {
                    $response['success'] = true;
                    $response['message'] = 'Pesan berhasil terkirim.';
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Gagal mengirim pesan. Silakan coba lagi.';
                }

                // Return respons dalam bentuk JSON
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        }
    }

    public function index() {
        $data['title'] = "Daftar Pesan";
        $data['pesan_list'] = $this->Pesan_model->get_all();
        $this->load->view('back/meta', $data);
      
        $this->load->view('back/sidebar', $data);
        $this->load->view('back/pesan/pesan_list', $data);
       
    }

    public function view($id) {
        $data['title'] = 'Detail Pesan';
        $data['pesan_detail'] = $this->Pesan_model->get_pesan_by_id($id);
        $this->load->view('back/pesan/pesan_view', $data);
    }
    
    public function delete($id) {
        $this->Pesan_model->delete_pesan($id);
        redirect('admin/pesan');
    }

    public function delete_multiple() {
        $ids = $this->input->post('ids');

        if (!empty($ids)) {
            $this->db->where_in('id', $ids);
            $this->db->delete('pesan');
            $response = array('success' => true);
        } else {
            $response = array('success' => false);
        }

        echo json_encode($response);
    }
}
?>
