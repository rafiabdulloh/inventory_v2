<?php

namespace App\Models\barang;
use CodeIgniter\Model;

class Barang extends Model
{
    protected $table      = 'barang';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['alias', 'created_by', 'qty', 'satuan', 'deskripsi', 'date_created'];

    public function __construct() {

        parent::__construct();
        $db      = \Config\Database::connect();
        $this->barang = $db->table('barang');
    }

    public function get_month($month)
    {
        $builder = $this->barang;
        $builder->select('*');
        $builder->where('MONTH(date_created)=',$month);
        $query = $builder->get();

        return $query->getResult();
    }
}
