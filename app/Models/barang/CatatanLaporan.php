<?php

namespace App\Models\barang;
use CodeIgniter\Model;

class CatatanLaporan extends Model
{
    protected $table      = 'catatan_laporan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['alias', 'qty', 'tujuan', 'satuan', 'deskripsi','status', 'date_created','status'];

}