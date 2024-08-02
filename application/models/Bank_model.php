<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank_model extends CI_Model
{
  public $table = 'bank';
  public $id    = 'id_bank';
  public $order = 'DESC';

  // Get all banks
  function get_all()
  {
    $this->db->order_by($this->id, $this->order);
    return $this->db->get($this->table)->result();
  }

  // Insert a new bank
  function insert($data)
  {
    return $this->db->insert($this->table, $data);
  }

  // Get a bank by ID
  function get_by_id($id)
  {
    $this->db->where($this->id, $id);
    return $this->db->get($this->table)->row();
  }

  // Update a bank
  function update($id, $data)
  {
    $this->db->where($this->id, $id);
    return $this->db->update($this->table, $data);
  }

  // Delete a bank
  function delete($id)
  {
    $this->db->where($this->id, $id);
    return $this->db->delete($this->table);
  }
}
?>
