<?php

namespace App\Controllers;

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

class Lokasidistribusi extends BaseController
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

    // tambah lokasi penerima
    public function add_location()
    {
        $lokasi = new Lokasi();
        $validation = \Config\Services::validation();
        $validation->setRules(['nama' => 'required']);
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $isvalid = $validation->withRequest($this->request)->run();


        if($isvalid){
            $lokasi->insert([
                'nama' => $nama,
                'alamat' => $alamat
            ]);
        }else{
            return "validation not correct";
        }

        return redirect('lokasi');
    }
    // view location
    public function lokasi()
    {
        $lokasi = new Lokasi();
        $barang = new Barang();
        $stok = new Stok();
        
        $pending = $this->pengiriman->get_status();
        $success = $this->pengiriman->status_success();
        $leadup = $this->pengiriman->status_leadUp();
        $pending_pen = $this->penerimaan->pending();
        
        $data['pending_pen']= $pending_pen;
        $data['success'] = $success;
		$data['pending'] = $pending;
		$data['leadup'] = $leadup;

        $data['barang'] = $barang->findAll();
        $data['stokBarang']=$stok->findAll();
        $data['lokasi'] = $lokasi->findAll();
        $data['accessibility'] = $this->session->get('accessibility');

        $data['title'] = "Lokasi";

        if(!session()->has('username'))
        {
        	return redirect()->to(base_url('login'));
        }else
        {
            return view('lokasi/lokasi', $data);
        }
    }

    // edit lokasi
    public function edit_lokasi($id)
    {
        $lokasi = new Lokasi();

        
        $valid = \Config\Services::validation();
        $valid->setRules(['nama' => 'required']);
        $isvalid = $valid->withRequest($this->request)->run();
        // return json_encode($id);
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        
        if($isvalid){
            $lokasi->update($id,[
                "nama" => $nama,
                "alamat" => $alamat,
            ]);

            return redirect('lokasi');
        }
    }
    // delete lokasi
    public function delete_lokasi($id)
    {
        $lokasi = new Lokasi();
        $do_delete = $lokasi->delete($id);
        // return json_encode($id);
        if($do_delete){
            $this->returnJson(array('status' => 'ok'));
        } else {
            $this->returnJson(array('status' => 'false')); 
        };

        return redirect('lokasi');
    }

}
