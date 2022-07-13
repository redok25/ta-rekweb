<?php
class Pin_model extends CI_Model
{
    private $table = 'pin';

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id" => $id])->row();
    }

    public function getByUser($username)
    {
        return $this->db->get_where($this->table, ["user_name" => $username])->result_array();
    }

    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);

        return true;
    }

    public function update()
    {
        $data = array(
            "user_name" => $this->input->post('user_name'),
            "lng" => $this->input->post('lng'),
            "lnt" => $this->input->post('lnt'),
            "nama" => $this->input->post('nama'),
        );
        return $this->db->update($this->table, $data, array('id' => $this->input->post('id')));
    }

    public function delete($id)
    {
        $this->db->delete($this->table, array("id" => $id));
        return true;
    }
}
