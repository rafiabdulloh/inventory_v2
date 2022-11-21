<?php

namespace App\Models\barang;
use CodeIgniter\Model;

class BarangKeluar extends Model
{
    protected $table      = 'barang_keluar';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['alias', 'qty', 'tujuan', 'satuan', 'deskripsi', 'date_created'];

}