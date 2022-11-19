<?php

namespace App\Controllers\Base;
use App\Models\barang\Barang;
use App\Models\barang\Stok;
use App\Models\barang\Pengiriman;
use App\Models\barang\CatatanLaporan;
use App\Models\barang\Penerimaan;
use App\Models\barang\BarangKeluar;
use App\Models\barang\Lokasi;
use App\Models\barang\User;
use App\Controllers\BaseController;

class StokBarang extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->barang = new Barang();
        $this->stok = new Stok;
        $this->pengiriman = new Pengiriman();
        $this->catatan_laporan = new CatatanLaporan();
        $this->barang_keluar = new BarangKeluar();
        $this->penerimaan = new Penerimaan();
        $this->lokasi = new Lokasi();
        $this->user = new User();
        $this->request = \Config\Services::request(); //memanggil class request

        $this->db= \Config\Services::connect();
    }
    public function returnJson($msg)
    {
        echo json_encode($msg);
        exit;
    }


    public function stok()
    {
        $stok = new Stok;
        $barang = new Barang();
        $lokasi = new Lokasi();

        $pending = $this->pengiriman->get_status();
        $success = $this->pengiriman->status_success();
        $leadup = $this->pengiriman->status_leadUp();
        $pending_pen = $this->penerimaan->pending();
        
        $data['pending_pen']= $pending_pen;
        $data['success'] = $success;

        $data['pending'] = $pending;
		$data['leadup'] = $leadup;

        $data['lokasi']=$lokasi->findAll();
        $data['barang'] = $barang->findAll();
        $data['stokBarang']=$stok->findAll();
        $data['accessibility'] =$this->session->get('accessibility');
        // return json_encode($data['lokasi']);
        $data['title'] = "Stok Barang";
        if(!session()->has('username'))
        {
        	return redirect()->to(base_url('login'));
        } else {

        return view('stok/stok', $data);

    }
    }

    // tambah stok == stok
    public function add_stok()
    {
        $stock = new Stok;
        $barang = new Barang;

        $valid = \Config\Services::validation();
        $valid->setRules(['qty' => 'required']);
        $isvalid = $valid->withRequest($this->request)->run();

        $alias=$this->request->getPost('alias');
        $name=ucfirst($alias);
        $created_by=$this->request->getPost('created_by');
        $qty=$this->request->getPost('qty');
        $satuan=$this->request->getPost('satuan');
        $deskripsi=$this->request->getPost('deskripsi');
        $get_stock = $stock->where('alias', $alias)->first();

        // return json_encode($get_stock['qty'] + ($qty / 1000));
        if($isvalid){
            // barang masuk
            $do_insert = $barang->insert([
                // "alias"=>$name,
                "alias"=>$alias,
                "created_by"=>$created_by,
                "qty"=>$qty,
                "satuan"=>$satuan,
                "deskripsi"=>$deskripsi
            ]);
            if($do_insert){ 
                if($satuan === "kg"){
                    $stock->update($get_stock['id'],[
                        "qty" =>$get_stock['qty'] + $qty
                    ]);
                    }
                if($satuan === "gram"){
                    $stock->update($get_stock['id'],[
                        "qty" =>    $get_stock['qty'] + ($qty / 1000)
                    ]);
                }
            }
            // return json_encode($qty+$get_stock['stok']);
            // exit;
            return redirect('stok/barang');
        }else{
            echo "data tidak valid";
        };
     
    }
            
        // == stok
    public function delete($id)
    
    {
        $stok = new Stok;
        $do_delete = $stok->delete($id);
        if($do_delete){
            $this->returnJson(array('status' => 'ok'));
        } else {
            $this->returnJson(array('status' => 'false')); 
        };

        return redirect('stok/barang');

    }
        // stok
    public function update_stok_brg($id)
    {
        $stok = new Stok();
        // $data['id'] = $stok->where('id', $id)->first();
        $validation =  \Config\Services::validation();
        $validation->setRules([
      'alias' => 'required',
      'qty' => 'required',
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if($isDataValid){
        $stok->update($id, [
            "alias" => $this->request->getPost('alias'),
            "qty" => $this->request->getPost('qty'),
        ]);
        // tanda
    }
    return redirect('stok/barang');

    }
}

