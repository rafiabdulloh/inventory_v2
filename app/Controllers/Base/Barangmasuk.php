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

class Barangmasuk extends BaseController
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


        $model = model(User::class);
        

    }
    public function returnJson($msg)
    {
        echo json_encode($msg);
        exit;
    }
    // view barang masuk
    public function barang_masuk()
    {
        $barang = new Barang();
        $stok = new Stok;
        $lokasi = new Lokasi();
        $data['barang'] = $barang->findAll();
        $data['stokBarang']=$stok->findAll();
        $data['lokasi']=$lokasi->findAll();
        $data['accessibility'] =$this->session->get('accessibility');
        $data['title'] = "Barang Masuk";

        $pending = $this->pengiriman->get_status();

        $success = $this->pengiriman->status_success();
        $leadup = $this->pengiriman->status_leadUp();
        $pending_pen = $this->penerimaan->pending();
        
        $data['pending_pen']= $pending_pen;
        $data['success'] = $success;
		$data['pending'] = $pending;
		$data['leadup'] = $leadup;
        



        if(!session()->has('username'))
        {
        	return redirect()->to(base_url('login'));
        } else {
            $id = session()->get('id');
            $nameUser = $this->user->get_name($id);
            $data['nameUser'] = $nameUser->name;
        return view('barang-masuk/barang_masuk', $data);
        }
    }

    // edit barang juga mengedit stok (disable) 
    public function edit_brg_to_stok($id)
    {

        $barang = new Barang();
        $stok = new Stok();
        // $data['id'] = $stok->where('id', $id)->first();
        $validation =  \Config\Services::validation();
        $validation->setRules([
      'alias' => 'required',
      'qty' => 'required',
        ]);
        
        $alias = $this->request->getPost('alias');
        $qty = $this->request->getPost('qty');
        $created_by = $this->request->getPost('created_by');
        $satuan = $this->request->getPost('satuan');
        $deskripsi = $this->request->getPost('deskripsi');
        
        $qty_brg = $barang->where('id' , $id)->first();
        $get_stok = $stok->where('alias', $alias)->first();
        $stok_brg = $get_stok['qty'];
        $id_stok = $get_stok['qty'];
        // return json_encode($qty_brg['qty']);

        $isDataValid = $validation->withRequest($this->request)->run();
        if($isDataValid){
        $barang->update($id, [
            "alias" => $alias,
            "qty" => $qty,
            "satuan" => $satuan,
            "created_by" => $created_by,
            "deskripsi" => $deskripsi,
            
        ]);
        
        if($stok_brg > $qty){
            $stok->update($get_stok['id'],[
                "qty" => $get_stok['qty']-($qty_brg['qty'] - $qty)
            ]);
        }
        if($stok_brg < $qty){
            $stok->update($get_stok['id'],[
                "qty" => $get_stok['qty']+($qty - $qty_brg['qty'])
            ]);
        }
        
        }
        return redirect('stok/barang');
    }

    // menghapus barang masuk (disable)
    public function delete_brg()
    {
        $barang = new Barang;
        $stok_barang = new Stok();
        $id=$this->request->getPost('id');
        $name=$this->request->getPost('alias');
        $qty=$this->request->getPost('qty');
        $get_stok=$stok_barang->where('alias',$name);
        // $qty=$barang->where('qty',$id);
        
        $do_delete = $barang->delete($id);  
        // return json_encode($id);
        if($do_delete){
            $this->returnJson(array('status' => 'ok'));
        } else {
            $this->returnJson(array('status' => 'false')); 
        };
        if($do_delete){
            $stok_barang->update($get_stok['id'],[
                "qty"=> $get_stok['qty']-$qty,

            ]);
        }
        
        return redirect('/');
        
        // return view('main/home');
        
             
    }

    public function add_barang_baru()
    {
        $stok_barang = new Stok;
        $barang = new Barang();
        $valid = \Config\Services::validation();
        $valid->setRules(['qty' => 'required']);
        $isvalid = $valid->withRequest($this->request)->run();

        $alias = $this->request->getPost('alias');
        $qty = $this->request->getPost('qty');

        $name=ucfirst($alias);
        $created_by=$this->request->getPost('created_by');
        $satuan=$this->request->getPost('satuan');
        $deskripsi=$this->request->getPost('deskripsi');

        if($isvalid){
            $stok_barang->insert([
                "alias" => $alias,
                "qty" => $qty,
            ]);

        }else{
            echo "datanya mana bang";
        };
        if($isvalid){
            $barang->insert([
                "alias"=>$alias,
                    "created_by"=>$created_by,
                    "qty"=>$qty,
                    "satuan"=>$satuan,
                    "deskripsi"=>$deskripsi

            ]);
        }
        
        return redirect('stok/barang');
    }
}
