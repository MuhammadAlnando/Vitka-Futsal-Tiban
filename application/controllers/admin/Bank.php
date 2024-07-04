<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Bank_model');
    }
    
    public function index() {
        $data['title'] = 'Data Bank'; // Tambahkan ini
        $data['data_bank'] = $this->Bank_model->get_all();
        $this->load->view('back/bank/bank_list', $data);
    }

    public function add() {
        $data['title'] = 'Tambah Bank'; // Tambahkan ini
        $this->load->view('back/bank/bank_form', $data);
    }

    public function save() {
        $data = [
            'nama_bank' => $this->input->post('nama_bank'),
            'atas_nama' => $this->input->post('atas_nama'),
            'norek' => $this->input->post('norek')
        ];
        $this->Bank_model->insert($data);
        redirect('admin/bank');
    }

    public function edit($id) {
        $data['title'] = 'Edit Bank'; // Tambahkan ini
        $data['bank'] = $this->Bank_model->get_by_id($id);
        $this->load->view('back/bank/bank_form', $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data = [
            'nama_bank' => $this->input->post('nama_bank'),
            'atas_nama' => $this->input->post('atas_nama'),
            'norek' => $this->input->post('norek')
        ];
        $this->Bank_model->update($id, $data);
        redirect('admin/bank');
    }

    public function delete($id) {
        $this->Bank_model->delete($id);
        redirect('admin/bank');
    }
}
?>
