<?php
class User_model extends CI_Model
{
    private $table = 'user';

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id" => $id])->row();
    }

    public function getByUsername($username)
    {
        return $this->db->get_where($this->table, ["username" => $username])->row();
    }

    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function save()
    {
        $data = array(
            "username" => $this->input->post('username'),
            "password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        );
        return $this->db->insert($this->table, $data);
    }

    public function update()
    {
        $data = array(
            "username" => $this->input->post('username'),
            "password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        );
        return $this->db->update($this->table, $data, array('id' => $this->input->post('id')));
    }

    public function ganti_password($id)
    {
        $data = array(
            "password" => password_hash($this->input->post('pw'), PASSWORD_DEFAULT),
        );
        return $this->db->update($this->table, $data, array('id' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array("id" => $id));
    }
}
