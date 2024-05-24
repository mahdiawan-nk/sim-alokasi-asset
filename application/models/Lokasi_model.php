<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi_model extends CI_Model
{
    private $table = 'lokasi';
    private $primaryKey = 'id';

    public function read($where = false, $key, $fieldKey)
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

    function delete($id, $data)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $data);
    }
}


/* End of file Lokasi_model.php and path \application\models\Lokasi_model.php */
