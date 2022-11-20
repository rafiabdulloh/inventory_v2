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

class Pengguna extends BaseController
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

    // tambah user 
    public function add_user()
    {
        $user = new User();
        $lokasi = new Lokasi();
        $stok = new Stok();
        $data['user'] = $user->findAll();
        $data['stokBarang']=$stok->findAll();
        $data['lokasi'] = $lokasi->findAll();
        $data['title'] = "Pengguna";

        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|is_unique[user.username]',
            'name' => 'required'
        ]);
        $isvalid = $validation->withRequest($this->request)->run();
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $accessibility = $this->request->getPost('accessibility');
        $name = $this->request->getPost('name');
        
        if($isvalid){
            $user->insert([
                'username' => $username,
                'password' => md5($password),
                'accessibility' => $accessibility,
                'name' => $name,
            ]);
            return redirect('user');
        }else{
            $this->session->setFlashdata('error', 'Username sudah ada');
            return view('user/user', $data);
        }        
    }

    // view user
    public function user()
    {
        $user = new User();
        $lokasi = new Lokasi();
        $stok = new Stok();

        $pending = $this->pengiriman->get_status();
        $success = $this->pengiriman->status_success();
        $leadup = $this->pengiriman->status_leadUp();
        $pending_pen = $this->penerimaan->pending();
        
        $data['pending_pen']= $pending_pen;
        $data['user'] = $user->findAll();
        $data['stokBarang']=$stok->findAll();
        $data['lokasi'] = $lokasi->findAll();
        $data['accessibility'] = $this->session->get('accessibility');
        $data['title'] = "Pengguna";
        $data['success'] = $success;
		$data['pending'] = $pending;
		$data['leadup'] = $leadup;
        $id = session()->get('id');
        $nameUser = $this->user->get_name($id);
        $data['nameUser'] = $nameUser->name;


        if(!$this->session->has('username')){
            return redirect('login');
        }else{
            return view('user/user', $data);
        }

    }
    // delete user
    public function delete_user($id)
    {
        $user = new User();
        $do_delete = $user->delete($id);
        // return json_encode($id);
        if($do_delete){
            $this->returnJson(array('status' => 'ok'));
        } else {
            $this->returnJson(array('status' => 'false')); 
        };

        return redirect('user');
    }
    // edit user
    public function edit_user($id)
    {
        $validation = \Config\Services::validation();
        $validation ->setRules(['password' => 'required']);
        $isvalid = $validation->withRequest($this->request)->run();

        $name = $this->request->getPost('name');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $accessibility = $this->request->getPost('accessibility');

        if($isvalid){
            $this->user->update($id,[
                'name' => $name,
                'username' => $username,
                'password' => md5($password),
                'accessibility' => $accessibility,
            ]);
            return redirect('user');
        }else{
            return json_encode("data tidak valid");
        }

    }
}
