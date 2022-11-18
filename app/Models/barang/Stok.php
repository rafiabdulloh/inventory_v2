<?php

namespace App\Models\barang;
use CodeIgniter\Model;

class Stok extends Model
{
    protected $table = 'stok_barang';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['alias', 'date_created', 'qty'];

    public function id()
    {
        return $this->where('id');
    }
}