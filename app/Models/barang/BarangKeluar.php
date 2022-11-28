<?php

namespace App\Models\barang;
use CodeIgniter\Model;

class BarangKeluar extends Model
{
    protected $table      = 'barang_keluar';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['alias', 'qty', 'tujuan', 'satuan', 'deskripsi', 'date_created'];

    public function __construct() {

        parent::__construct();
        $db      = \Config\Database::connect();
        $this->barang_keluar = $db->table('barang_keluar');
    }

    public function get_month($month)
    {
        $builder = $this->barang_keluar;
        $builder->select('*');
        $builder->where('MONTH(date_created)=',$month);
        $query = $builder->get();

        return $query->getResult();
    }
}