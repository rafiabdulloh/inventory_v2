<?php

namespace App\Models\barang;
use CodeIgniter\Model;

class Stok extends Model
{
    protected $table = 'stok_barang';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['alias', 'date_created', 'qty'];

    public function __construct() {

        parent::__construct();
        $db      = \Config\Database::connect();
        $this->stok = $db->table('stok_barang');
    }
    public function get_stok($alias)
    {
        $builder = $this->stok;
        $builder->select('qty');
        $builder->where('alias', $alias);
        $query = $builder->get();

        return $query->getRow();
    }
}