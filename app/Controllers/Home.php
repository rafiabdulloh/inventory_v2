<?php

namespace App\Controllers;
use App\Models\barang\Barang;
use App\Models\barang\Stok;
use App\Models\barang\Pengiriman;
use App\Models\barang\CatatanLaporan;
use App\Models\barang\Penerimaan;
use App\Models\barang\BarangKeluar;
use App\Models\barang\Lokasi;
use App\Models\barang\User;
use CodeIgniter\Debug\Toolbar\Collectors\Logs;

class Home extends BaseController
{
	// kayanya tidak perlu
	public function index()
	{
		$this->session = session();
        $this->user = new User();

		$penerimaan = new Penerimaan();
		$stok = new Stok();
		$pengiriman = new Pengiriman();
		$selesai = new CatatanLaporan();
		$barang_masuk = new Barang();
		$barang_keluar = new BarangKeluar();
		$user = new User();
		$lokasi = new Lokasi();

        $pending = $pengiriman->get_status();
        $success = $pengiriman->status_success();
        $leadup = $pengiriman->status_leadUp();
		$pending_pen = $penerimaan->pending();
		
        $data['pending_pen']= $pending_pen;
		$data['selesai'] = $selesai->findAll();
		$data['pengiriman'] = $pengiriman->findAll();
		$data['stok'] = $stok->findAll();
		$data['penerimaan'] = $penerimaan->findAll();
		$data['barang_masuk'] = $barang_masuk->findAll();
		$data['barang_keluar'] = $barang_keluar->findAll();
		$data['user'] = $user->findAll();
		$data['lokasi'] = $lokasi->findAll();
		$data['title'] = "Dashboard";
		$data['pending'] = $pending;
		$data['pending_pen'] = $pending_pen;
		$data['success'] = $success;
		$data['leadup'] = $leadup;
        $data['accessibility'] = $this->session->get('accessibility');
        // return json_encode($nameUser->name);
		
		if(!session()->has('username'))
        {
			return redirect()->to(base_url('login'));
			
        } else {
			$id = session()->get('id');
			$nameUser = $this->user->get_name($id);
			$data['nameUser'] = $nameUser->name;
		return view('dashboard/dashboard', $data);}
		
	}
}
