<!-- Tambah Stok -->
<div>
	<div class="modal fade" id="tambah-stok"  role="dialog">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content" style="margin-top:80px">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Tambah Stok Barang</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="/add" method="post">
	            <label for="recipient-name" class="col-form-label">Pilih nama barang:</label>
                <select name="alias" id="" class="select form-group col-form-label form-control">
                    <option value="" selected disabled hidden>-- Pilih Barang --</option>
                    
					<?php foreach($stokBarang as $stok):?>
						<option style="text-transform:capitalize" value="<?= $stok['alias']?>">
							<?= $stok['alias']?>
							<!-- ucfirst -->
						</option>
					<?php endforeach ?>
                </select>
	            <div class="form-group">
	                <label for="recipient-name" class="col-form-label">Pengirim</label>
                    <input placeholder="Masukan nama anda" class="form-control" type="text" name="created_by" autocomplete="off" style="text-transform:capitalize" required>
	            </div>
                <div class="form-group">
	                <label for="recipient-name" class="col-form-label">Jumlah: </label>
                    <input placeholder="Masukan angka" class="form-control" type="number" min="0" name="qty" id="total" required>
	            </div>
	            <label for="recipient-name" class="col-form-label">Satuan:</label>
                <select name="satuan" id="" class="select form-group col-form-label form-control" required>
                <option value="" selected disabled hidden>-- Pilih satuan --</option>
                    <option value="kg">Kilogram</option>
                    <option value="gram">Gram</option>
                </select>
	            <div class="form-group">
	              <label for="message-text" class="col-form-label">Deskripsi</label>
                    <textarea class="form-control" placeholder="masukan deskripsi disini..." type="number" name="deskripsi"></textarea>
	            </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="submit" type="submit" name="submit" value="Send">Send</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
</div>
<!-- Tambah barang -->
<div id="tambah-barang" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="margin-top:80px">
      <div class="modal-header">
		  <h4 class="modal-title">Tambahkan Barang</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
	  		<form action="/add/barang/baru" method="post">
				<div class="form-group">
	                <label for="recipient-name" class="col-form-label" >Nama</label>
                    <input placeholder="Sayuran" class="form-control" autocomplete="off" type="text" name="alias" style="text-transform:capitalize" required>
	            </div>
                <div class="form-group">
	                <label for="recipient-name" class="col-form-label">Jumlah</label>
                    <input placeholder="Masukan angka" class="form-control" type="number" min="0" name="qty" id="total" required>
	            </div>
	            <label for="recipient-name" class="col-form-label">Satuan:</label>
                <select name="satuan" id="" class="select form-group col-form-label form-control">
                    <option value="kg">Kilogram</option>
                </select>
				<div class="form-group">
	                <label for="recipient-name" class="col-form-label">Pengirim</label>
                    <input placeholder="Masukan nama anda" class="form-control" type="text" name="created_by" autocomplete="off" style="text-transform:capitalize" required>
	            </div>
				<div class="form-group">
	              <label for="message-text" class="col-form-label">Deskripsi</label>
                    <textarea class="form-control" placeholder="masukan deskripsi disini..." type="number" name="deskripsi"></textarea>
	            </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="submit" type="submit" name="submit" value="Send">Send</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
	        </form>
      </div>
    </div>
  </div>
</div>

<!-- kirim barang -->
<div id="kirim" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="margin-top:80px">
            <div class="modal-header">
                <h3 class="modal-title">Kirim barang ke tujuan</h3>
                <button class="close" type="button" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form action="/kirim/barang" method="post">
				<div class="form-group">
	                <label for="recipient-name" class="col-form-label">Nama</label>
                        <select name="alias" id="alias" class="select form-group col-form-label form-control">
                    <option value="" selected disabled hidden>-- Pilih Barang --</option>
					<?php foreach($stokBarang as $stok):?>
						<option value="<?= $stok['alias']?>" class="qty">
							<?= ucFirst($stok['alias'])?>
						</option>
					<?php endforeach ?>
                    </select>
	            </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Tujuan</label>
                    <select name="tujuan" id="" class="select form-group col-form-label form-control">
                        <option value="" selected disabled hidden>-- Pilih tujuan --</option>
                        <?php foreach($lokasi as $loc):?>
                        <option value="<?= $loc['nama']?> <?= $loc['alamat']?>" style="text-transform:capitalize"><?= $loc['nama']?> <?= $loc['alamat']?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
	                <label for="recipient-name" class="col-form-label">Jumlah <span id="current_stock"></span></label>
                    <input placeholder="Masukan angka" class="form-control" type="number" min="0" name="qty" id="total" required>
	            </div>
	            <label for="recipient-name" class="col-form-label">Satuan:</label>
                <select name="satuan" id="" class="select form-group col-form-label form-control">
                    <option value="kg">Kilogram</option>
                </select>
                <div class="form-group">
                     <label for="recipient-name" class="col-form-label">Deskripsi</label>
                     <textarea name="deskripsi" class="form-control" id="deskripsi" cols="10" placeholder="Tuliskan deskripsi tujuan disini..."></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="submit" type="submit" name="submit" value="Send">Send</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
			</form>
            </div>
        </div>
    </div>
</div>


<!-- tambah penerimaan -->
<div id="penerimaan" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="margin-top:80px">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Penerimaan</h3>
                <button class="close" type="button" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form action="/tambah/penerimaan" method="post">
				<div class="form-group">
	                <label for="recipient-name" class="col-form-label">Nama</label>
                    <input placeholder="pilih atau tambahkan barang baru" class="form-control" type="text" name="alias" autocomplete="off" required list="list-alias">
                    <datalist id="list-alias">
                        <!-- <option value="" selected disabled hidden>-- Pilih Barang --</option> -->
                        <?php foreach($stokBarang as $stok):?>
                            <option value="<?= $stok['alias']?>" style="text-transform:capitalize">
                                
                            </option>
                            <?php endforeach ?>
                    </datalist>
                        <!-- <select name="alias" id="" class="select form-group col-form-label form-control" required>
                        
                    </select> -->
	            </div>
                <div class="form-group">
	                <label for="recipient-name" class="col-form-label">Jumlah</label>
                    <input placeholder="Masukan angka" class="form-control" type="number" min="0" name="qty" id="total" required>
	            </div>
	            <label for="recipient-name" class="col-form-label">Satuan:</label>
                <select name="satuan" id="" class="select form-group col-form-label form-control" required>
                    <option value="kg">Kilogram</option>
                </select>
                <div class="form-group">
					<label for="recipient-name" class="col-form-label">Barang dari</label>
					<input placeholder="Barang dari" class="form-control" type="text" name="from" autocomplete="off" required style="text-transform:capitalize">
				</div>
				<div class="form-group">
					<label for="recipient-name" class="col-form-label">Harga</label>
					<input placeholder="Masukan angka" class="form-control" type="text" id="rupiah" name="harga" min="0" autocomplete="off" required>
				</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="submit" type="submit" name="submit" value="Send">Send</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
			</form>
            </div>
        </div>
    </div>
</div>

<!-- modal tambah lokasi pengiriman -->
<div id="tambah-lokasi" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:80px">
      <div class="modal-header">
		  <h4 class="modal-title">Tambahkan Lokasi Penerima</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
	  	<form action="/add/lokasi" method="post">
			<div class="form-group">
	            <label for="recipient-name" class="col-form-label" >Nama Penerima</label>
                <input placeholder="Nama penerima" class="form-control" autocomplete="off" type="text" name="nama" style="text-transform:capitalize" required>
	        </div>
			<div class="form-group">
	            <label for="recipient-name" class="col-form-label">Alamat</label>
                <input placeholder="Contoh: Bintaro no 12, Tangerang selatan" class="form-control" type="text" name="alamat" autocomplete="off" style="text-transform:capitalize" required>
	        </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="submit" type="submit" name="submit" value="Send">Send</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
	    </form>
      </div>
    </div>
  </div>
</div>

<!-- tambah user -->
<div id="tambah-user" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:80px">
      <div class="modal-header">
		  <h4 class="modal-title">Tambahkan User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
	  	<form action="/add/user" method="post">
            <div class="form-group">
	            <label for="recipient-name" class="col-form-label" >Nama</label>
                <input placeholder="Masukan nama anda" class="form-control" autocomplete="off" type="text" name="name" required style="text-transform:capitalize">
	        </div>
            <div class="form-group">
	            <label for="recipient-name" class="col-form-label" >Username</label>
                <input placeholder="username" class="form-control" autocomplete="off" type="text" name="username" required>
	        </div>
			<div class="form-group">
	            <label for="recipient-name" class="col-form-label">Password</label>
                <!-- <input placeholder="password" class="form-control" autocomplete="off" type="password" name="password" required> -->
                <div class="input-group">
                    <input name="password" type="password" id="pass" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <!-- eye fitur to show and hide password -->
                            <span id="mybutton" onclick="change()" class="mata input-group-text">
                             <!-- eye icon bootstrap  -->
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path fill-rule="evenodd"
                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                            </span>
                      </div>
                </div>
	        </div>
            <div class="form-group">
	            <label for="recipient-name" class="col-form-label">Accessibility</label>
                <select name="accessibility" id="" class="select form-group col-form-label form-control" required>
                <option value="" selected disabled hidden>-- Pilih Hak Akses --</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
	        </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="submit" type="submit" name="submit" value="Send">Send</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
	    </form>
      </div>
    </div>
  </div>
</div>

<!-- edit stok barang -->
<div id="edit-stok" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
		  <h4 class="modal-title">Edit data stok barang</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="myform" action="/edit/stok/" method="post">
            <label for="">Nama:</label>
            <input type="text" class="alias form-control" name="alias" autocomplete="off" id="alias">
            <label for="">Stok:</label>
            <input type="number" class="stok form-control" name="qty" id="stok">
                <div class="modal-footer">
                    <button class="btn btn-primary" id="submit" type="submit" name="submit">Send</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
        </form>
        <div class="coba"></div>
      </div>
    </div>
  </div>
</div>

<!-- modal edit lokasi pengiriman -->
<div id="edit-lokasi" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:80px">
      <div class="modal-header">
		  <h4 class="modal-title">Edit Lokasi Penerima</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
	  	<form action="" method="post" id="modal-lokasi">
			<div class="form-group">
	            <label for="recipient-name" class="col-form-label" >Nama Penerima</label>
                <input placeholder="Nama penerima" class="form-control nama" autocomplete="off" type="text" name="nama" style="text-transform:capitalize" required>
	        </div>
			<div class="form-group">
	            <label for="recipient-name" class="col-form-label">Alamat</label>
                <input placeholder="Contoh: Bintaro no 12, Tangerang selatan" class="form-control alamat" type="text" name="alamat" autocomplete="off" style="text-transform:capitalize" required>
	        </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="submit" type="submit" name="submit" value="Send">Send</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
	    </form>
      </div>
    </div>
  </div>
</div>

<!-- modal edit user -->
<div id="edit-user" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:80px">
      <div class="modal-header">
		  <h4 class="modal-title">Edit Pengguna</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
	  	<form action="" method="post" id="modal-user">
          <div class="form-group">
	            <label for="recipient-name" class="col-form-label" >Nama</label>
                <input placeholder="Masukan nama anda" class="form-control name" autocomplete="off" type="text" name="name" required style="text-transform:capitalize">
	        </div>
            <div class="form-group">
	            <label for="recipient-name" class="col-form-label" >Username</label>
                <input placeholder="username" class="form-control username" autocomplete="off" type="text" name="username" required readonly>
	        </div>
			    <div class="form-group">
	            <label for="recipient-name" class="col-form-label">Password</label>
                <!-- <input placeholder="password" class="form-control" autocomplete="off" type="password" name="password" required> -->
                <div class="input-group">
                    <input name="password" type="password" id="pw" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                            <!-- eye fitur to show and hide password -->
                      <span id="eye" onclick="change_icon()" class="mata input-group-text">
                             <!-- eye icon bootstrap  -->
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                            <path fill-rule="evenodd"
                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                        </svg>
                      </span>
                    </div>
                </div>
	        </div>
            <div class="form-group">
	            <label for="recipient-name" class="col-form-label">Accessibility</label>
                <select name="accessibility" id="" class="select form-group col-form-label form-control accessibility" required>
                <option value="" selected disabled hidden>-- Pilih Hak Akses --</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
	        </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="submit" type="submit" name="submit" value="Send">Send</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
	    </form>
      </div>
    </div>
  </div>
</div>