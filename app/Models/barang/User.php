<?php

namespace App\Models\barang;
use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['username', 'password', 'accessibility', 'name'];

    public function __construct() {

        parent::__construct();
        $db      = \Config\Database::connect();
        $this->user = $db->table('user');
    }
    
    // public function id()
    // {
    //     return $this->where('id');
    // }

    public function get_user($data){
        $query = $this->where($data)->get();
        return $query->getRow();
    }
    public function get_name($id){
        $builder = $this->user;
        $builder->select('name');
        $builder->where('id', $id);
        $query = $builder->get();

        return $query->getRow();
    }
}