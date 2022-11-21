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

class Pengirimanbarang extends BaseController
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

    // kirim barang
    public function kirim()
    {
        $stock = new Stok;
        $barang = new Pengiriman();
        $barang_keluar = new BarangKeluar();
        $valid = \Config\Services::validation();
        $valid->setRules(['tujuan' => 'required']);
        $isvalid = $valid->withRequest($this->request)->run();

        $alias=$this->request->getPost('alias');
        $qty=$this->request->getPost('qty');
        $satuan=$this->request->getPost('satuan');
        $tujuan=$this->request->getPost('tujuan');
        $deskripsi=$this->request->getPost('deskripsi');
        $get_stock = $stock->where('alias', $alias)->first();
        $stok_stok = $get_stock['qty'];

            if($qty<=$stok_stok && $isvalid){               //hanya tereksekusi jika stok barang ada atau cukup
                $do_insert = $barang->insert([
                    "alias"=>$alias,
                    "qty"=>$qty,
                    "satuan"=>$satuan,
                    "tujuan"=>$tujuan,
                    "deskripsi"=>$deskripsi
                ]);
                
                if($do_insert){ 
                        $stock->update($get_stock['id'],[
                            "qty" =>$get_stock['qty']-$qty
                        ]);
                    };
                    
            }else{
                // belum ada peringatan stok kurang
                return redirect('stok/barang');
            };

            return redirect('pengiriman');
    }
    //view pengiriman
    public function pengiriman()
    {
        $pengiriman = new Pengiriman();
        $stok = new Stok;
        $lokasi = new Lokasi();

        $pending = $this->pengiriman->get_status();
        $success = $this->pengiriman->status_success();
        $leadup = $this->pengiriman->status_leadUp();
        $pending_pen = $this->penerimaan->pending();
        
        $data['pending_pen']= $pending_pen;
        $data['pengiriman']= $pengiriman->findAll();
        $data['stokBarang']=$stok->findAll();
        $data['lokasi']=$lokasi->findAll();
        $data['accessibility'] =$this->session->get('accessibility');
        $data['title'] = "Pengiriman";

        $data['pending'] = $pending;
		$data['leadup'] = $leadup;

        $data['success'] = $success;
        


        // $status_pengiriman = $pengiriman->findColumn('status');
        // return json_encode($pending);
        
        
        // return json_encode($nol);

        if(!session()->has('username'))
        {
        	return redirect()->to(base_url('login'));
        } else {
            $id = session()->get('id');
            $nameUser = $this->user->get_name($id);
            $data['nameUser'] = $nameUser->name;
        return view('pengiriman/pengiriman', $data);
        }
    }

    // accept pengiriman status selesai
    public function status_pengiriman($id)
    {
        $catatan_laporan = new CatatanLaporan();
        $pengiriman = new Pengiriman();
        $barang_keluar = new BarangKeluar();
        // return json_encode($id);

        
        $get_pengiriman = $pengiriman->where('id', $id)->first();

        $doFor_status = $pengiriman->update($get_pengiriman['id'],["status" => 1]);      

        if($doFor_status)
        {
            $catatan_laporan->insert([
                'alias'=> $get_pengiriman['alias'],
                'qty'=> $get_pengiriman['qty'],
                'satuan'=> $get_pengiriman['satuan'],
                'tujuan'=> $get_pengiriman['tujuan'],
                'deskripsi'=> $get_pengiriman['deskripsi'],
                'status' => 1
            ]);


            $this->returnJson(array('status' => 'ok'));
        }else
            {
                $this->returnJson(array('status' => 'false'));
            };   
        
        return redirect('pengiriman');
    }

    public function batal($id, $alias, $qty)
    {
        $pengiriman = new Pengiriman();
        $stok = new Stok();
        $catatan_laporan = new CatatanLaporan();

        $get_stok = $stok->where('alias', $alias)->first();
        // return json_encode($get_stok);
        // $do_delete = $pengiriman->delete($id);    

        // if($do_delete){
            $stok->update($get_stok['id'],[
                "qty" => $get_stok['qty']+$qty,
            ]);
        // }

        $get_status = $pengiriman->where('id', $id)->first();
        // return json_encode($get_status['status']);

        $doFor_status = $pengiriman->update($get_status['id'],["status" => 2]);      

        if($doFor_status){
            $catatan_laporan->insert([
                'alias'=> $get_status['alias'],
                'qty'=> $get_status['qty'],
                'satuan'=> $get_status['satuan'],
                'tujuan'=> $get_status['tujuan'],
                'deskripsi'=> $get_status['deskripsi'],
                'status' => 2
            ]);

            $this->returnJson(array('status' => 'ok'));
        }else{
            $this->returnJson(array('status' => 'false'));
        }
        
        return redirect('pengiriman');
    }
       
    

     //kirim 3
    public function stts_kirim($id)
    {
        // $selesai = new CatatanLaporan();
        $stok = new Stok();
        $pengiriman = new Pengiriman();
        $barang_keluar = new BarangKeluar();
        $get_pengiriman = $pengiriman->where('id', $id)->first();
        $get_stok = $stok->where('alias', $get_pengiriman['alias'])->first();
        // return json_encode($get_stok);

        $do_update = $pengiriman->update($get_pengiriman['id'],['status' => 3]);
        if($do_update){

            $barang_keluar->insert([
                'alias'=> $get_pengiriman['alias'],
                'qty'=> $get_pengiriman['qty'],
                'satuan'=> $get_pengiriman['satuan'],
                'tujuan'=> $get_pengiriman['tujuan'],
                'deskripsi'=> $get_pengiriman['deskripsi'],
            ]);
            $this->returnJson(array('status' => 'ok'));
        }else{
            $this->returnJson(array('status' => 'false'));
        }
        
        return redirect('pengiriman');
    }
}
