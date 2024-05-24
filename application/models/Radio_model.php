<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Radio_model extends CI_Model 
{
    private $table = 'radio';
    private $primaryKey = 'id';

    public function read($where = false,$key,$fieldKey)
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

    function delete($id,$data)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $data);
    }                      
                       
    function countAll(){
        return $this->db->count_all_results($this->table);
    }
}


/* End of file Radio_model.php and path \application\models\Radio_model.php */
