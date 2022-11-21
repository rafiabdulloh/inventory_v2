<?php

namespace App\Models\barang;
use CodeIgniter\Model;

class Penerimaan extends Model
{
    protected $table      = 'penerimaan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['alias', 'qty', 'harga', 'satuan', 'from', 'date_created', 'status'];

    public function __construct() {

        parent::__construct();
        $db      = \Config\Database::connect();
        $this->penerimaan = $db->table('penerimaan');
    }
    public function pending()
    {
        $builder = $this->penerimaan;
        $builder->select('id');
        $builder->where('status', 0);
        $query = $builder->get();

        return $query->getNumRows();
    }
}