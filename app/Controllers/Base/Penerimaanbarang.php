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

class Penerimaanbarang extends BaseController
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
    // view penerimaan
    public function penerimaan()
    {
        $penerimaan = new Penerimaan();
        $stok = new Stok;
        $lokasi = new Lokasi();
        
        $pending = $this->pengiriman->get_status();
        $success = $this->pengiriman->status_success();
        $leadup = $this->pengiriman->status_leadUp();
        $pending_pen = $this->penerimaan->pending();
        
        // return json_encode($pending_pen);
        
        
        $data['pending_pen']= $pending_pen;
        $data['stokBarang']=$stok->findAll();        
        $data['penerimaan']=$penerimaan->findAll();
        $data['lokasi']=$lokasi->findAll();
        $data['accessibility'] =$this->session->get('accessibility');
        $data['title'] = "Penerimaan";
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
            
        return view('penerimaan/penerimaan', $data);
        }
    }
    
    public function tambah_penerimaan()
    {
        $penerimaan = new Penerimaan();
        $validation = \Config\Services::validation();
        $validation->setRules(['alias' => 'required']);
        $valid = $validation->withRequest($this->request)->run();

        $this->penerimaan->pending();
        $alias = $this->request->getPost('alias');
        $qty = $this->request->getPost('qty');
        $satuan = $this->request->getPost('satuan');
        $from = $this->request->getPost('from');
        $harga = $this->request->getPost('harga');
        // $format_harga = format_number($harga, 0, '', );
        $jumlah = str_replace(".","",$harga);

        if($valid){
            $penerimaan->insert([
                "alias" => $alias,
                "qty" => $qty,
                "satuan" => $satuan,
                "from" => $from,
                "harga" => $jumlah,
            ]);

            
        }
        return redirect('penerimaan');
    }
    //penerimaan barang accept
    public function accept_penerimaan($id)
    {
        $penerimaan = new Penerimaan();
        $stok = new Stok();
        $barang = new Barang();
        $stok_pen = $penerimaan->where('id', $id)->first();
        $get_stok = $stok->where('alias', $stok_pen['alias'])->first();
        // $get_stok_all = $stok->findAll();
                
            if($get_stok !== null){

                $do_accept = $stok->update($get_stok['id'],[
                    'qty' => $get_stok['qty']+$stok_pen['qty']
                ]);

            $do_accept;

            $barang->insert([
                'alias' => $stok_pen['alias'],
                'qty' => $stok_pen['qty'],
                'created_by' => $stok_pen['from'],
                'satuan' => $stok_pen['satuan'],
                'deskripsi' => "Barang dari ". $stok_pen['from'],
            ]);
            
            $penerimaan->update($id,[
                'status' => 1
            ]);
            $this->returnJson(array('status' => 'ok'));
            }else{
                $this->returnJson(array('status' => 'false'));
            
            }  
            if($get_stok == null){
            // jika barang belum ada
            $barang->insert([
                'alias' => $stok_pen['alias'],
                'qty' => $stok_pen['qty'],
                'created_by' => $stok_pen['from'],
                'satuan' => $stok_pen['satuan'],
                'deskripsi' => "Barang dari ". $stok_pen['from'],

            ]);
            $stok->insert([
                'alias' => $stok_pen['alias'],
                'qty' => $stok_pen['qty'],
            ]);

            $penerimaan->update($id,[
                'status' => 1
            ]);
            
            $this->returnJson(array('status' => 'ok'));
            }else{
                $this->returnJson(array('status' => 'false'));
            }
        

        return redirect('penerimaan');

    }
    public function cancel_penerimaan($id)
    {
        $penerimaan = new Penerimaan();
        // return json_encode($id);
        $cancel = $penerimaan->update($id,[
            'status' => 2
        ]);
        if($cancel){
            $this->returnJson(array('status' => 'ok'));
            }else{
                $this->returnJson(array('status' => 'false'));
            
        }

        return redirect('penerimaan');
    }
}
