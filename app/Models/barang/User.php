<?php

namespace App\Models\barang;
use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['username', 'password', 'accessibility', 'name'];

    // public function __construct() {

    //     parent::__construct();
    //     $db      = \Config\Database::connect();
    //     $this->users = $db->table('users');
    // }
    
    // public function id()
    // {
    //     return $this->where('id');
    // }

    public function get_user($data){
        $query = $this->where($data)->get();
        return $query->getRow();
    }
}