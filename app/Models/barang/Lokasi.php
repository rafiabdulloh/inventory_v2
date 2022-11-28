<?php

namespace App\Models\barang;
use CodeIgniter\Model;

class Lokasi extends Model
{
    protected $table      = 'lokasi';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama', 'alamat'];

}