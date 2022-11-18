<?php

namespace App\Models\barang;
use CodeIgniter\Model;

class Barang extends Model
{
    protected $table      = 'barang';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['alias', 'created_by', 'qty', 'satuan', 'deskripsi', 'date_created'];

    // protected $allowedFields = ['name', 'email'];
    
    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';
    
    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}
