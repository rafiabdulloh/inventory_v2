<?php

namespace App\Models\barang;
use CodeIgniter\Model;

class CatatanLaporan extends Model
{
    protected $table      = 'catatan_laporan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['alias', 'qty', 'tujuan', 'satuan', 'deskripsi','status', 'date_created','status'];

    public function __construct() {

        parent::__construct();
        $db      = \Config\Database::connect();
        $this->catatan = $db->table('catatan_laporan');
    }

    public function get_month($month)
    {
        $builder = $this->catatan;
        $builder->select('*');
        $builder->where('MONTH(date_created)=',$month);
        $query = $builder->get();

        return $query->getResult();
    }
}