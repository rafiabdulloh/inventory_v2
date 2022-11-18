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
use CodeIgniter\CLI\Console;
use CodeIgniter\Debug\Toolbar\Collectors\Logs;
use CodeIgniter\Router\Router;
use CodeIgniter\Validation\Validation;

class Home extends BaseController
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

    public function tambahBarang()
    {
        if(!session()->has('username'))
        {
        	return redirect()->to(base_url('login'));
        } else {
        $data['sawi'] = $this->request->getPost('sawi');
        $data['total'] = $this->request->getPost('total');
        $data['accessibility'] =$this->session->get('accessibility');

        // return json_encode($data);
        // exit;
        // $this->home();
        return view('dashboard/dashboard',$data);
        }
    }

    // view selesai
    public function selesai()
    {
        $catatan_laporan = new CatatanLaporan();
        $lokasi = new Lokasi();
        $stok = new Stok;
        $pending = $this->pengiriman->get_status();
        $success = $this->pengiriman->status_success();
        $leadup = $this->pengiriman->status_leadUp();
        $pending_pen = $this->penerimaan->pending();
        
        $data['pending_pen']= $pending_pen;
        $data['laporan']= $catatan_laporan->findAll();
        $data['stokBarang']=$stok->findAll();
        $data['lokasi']=$lokasi->findAll();
        $data['accessibility'] =$this->session->get('accessibility');
        $data['title'] = "Catatan Laporan Selesai";
        $data['success'] = $success;

        $data['pending'] = $pending;
        $data['leadup'] = $leadup;
        if(!session()->has('username'))
        {
        	return redirect()->to(base_url('login'));
        } else {

        return view('selesai/selesai', $data);
        }
    }
    
    // view barang keluar
    public function barang_keluar()
    {
        $keluar = new BarangKeluar();
        $stok = new Stok;
        $lokasi = new Lokasi;
        $pending = $this->pengiriman->get_status();
        $success = $this->pengiriman->status_success();
        $leadup = $this->pengiriman->status_leadUp();
        $pending_pen = $this->penerimaan->pending();
        
        $data['pending_pen']= $pending_pen;
        $data['lokasi']=$lokasi->findAll();
        $data['keluar']=$keluar->findAll();
        $data['stokBarang']=$stok->findAll();
        $data['accessibility'] =$this->session->get('accessibility');
        $data['title'] = "Barang Keluar";
        $data['success'] = $success;

        $data['pending'] = $pending;
        $data['leadup'] = $leadup;
        if(!session()->has('username'))
        {
        	return redirect()->to(base_url('login'));
        } else {

        echo view('barang-keluar/barang_keluar', $data);
        }
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

    // login
    public function login()
    {
        if(session()->has('username'))
        {
        	return redirect()->to(base_url('/'));
        } else {

        return redirect('login');
        }
    }

    // login submit
    public function do_login()
    {
        // $this->UserModel = new UsersModel();
        $data['username'] = $this->request->getPost('username');
        $data['password'] = md5($this->request->getPost('password'));
        $hasil = $this->user->get_user($data);
        // $this->returnJson($hasil->id);
        ///$setting = $this->UsersModel->get_setting();
        if($hasil !== null)
        {
            // set session
            $dataSesi = [
                     'id' => $hasil->id,
                     'username' => $hasil->username,
                     'password' => $hasil->password,
                     'accessibility' => $hasil->accessibility,
                     'name' => $hasil->name,
                 ];
            $this->session->set($dataSesi);
            return redirect()->to(base_url('/'));
            exit();
        }else{
            $this->session->setFlashdata('error', 'Plesae check your username or password');
            return view('auth/login');
        }	
    }

    //logout
    public function logout()
    {
        session()->destroy();
        return redirect('login');
    }

    // view contact
    public function contact()
    {
        $pending = $this->pengiriman->get_status();
        $leadup = $this->pengiriman->status_leadUp();
        $pending_pen = $this->penerimaan->pending();
        
        $data['pending_pen']= $pending_pen;
		$data['pending'] = $pending;
		$data['leadup'] = $leadup;
        $data['accessibility'] =$this->session->get('accessibility');


        $data['title'] = "Contact";
        if(!session()->has('username'))
        {
        	return redirect()->to(base_url('login'));
        }else
        {
            return view('contact/contact', $data);
        }
    }
}