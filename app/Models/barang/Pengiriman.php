<?php

namespace App\Models\barang;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Model;

class Pengiriman extends Model
{
    protected $table      = 'pengiriman';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['alias', 'qty', 'tujuan', 'satuan', 'deskripsi', 'date_created', 'status'];

    public function __construct() {

        parent::__construct();
        $db      = \Config\Database::connect();
        $this->pengiriman = $db->table('pengiriman');
    }

    public function get_status()
    {
        
        // builder adalah database pengiriman 
        $builder = $this->pengiriman;
        // pilih idnya
        $builder->select('id');
        // dimana id yang berstatus 0
        $builder->where('status', 0);
        // tampilkan hasil dari query
        $query = $builder->get();
        // kembalikan hasil dari query
        return $query->getNumRows();
    }
    public function status_success()
    {
        $builder = $this->pengiriman;
        $builder->select('id');
        $builder->where('status', 1);
        $query = $builder->get();

        return $query->getNumRows();
    }
    public function status_leadUp()
    {
        $builder = $this->pengiriman;
        $builder->select('id');
        $builder->where('status', 3);
        $query = $builder->get();

        return $query->getNumRows();
    }
    
}