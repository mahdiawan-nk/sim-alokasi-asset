<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    private $table = 'admin';
    private $primaryKey = 'id_admin';

    public function read($where = false, $key=null, $fieldKey=null)
    {
        if ($where) {
            $result = $this->db->select('*')
                ->where($fieldKey, $key)
                ->from($this->table)
                ->get();
        } else {
            $result = $this->db->select('*')
                ->from($this->table)
                ->get();
        }

        return $result;
    }

    function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    function update($id, $data)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->delete($this->table);
    }
    function SelectAccountUser($data)
    {
        $this->db->where('email', $data['identity']);
        $this->db->or_where('username', $data['identity']);
        $query = $this->db->get($this->table,1)->row();
        if($query){
           if($query->password == $data['password']){
            return $query;
           }
            
        }
        return false;
    }

    
}


/* End of file Admin_model.php and path \application\models\Admin_model.php */
