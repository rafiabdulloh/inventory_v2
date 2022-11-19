$(document).ready(function () {
  $("#history").click(function () {
    $("#history-barang").fadeToggle();
  });
});

// ============================== barang sekarnag ==================
var total = $("#total").val();
var sawi = $("#sawi").val();
$(document).ready(function () {
  $("#submit").click(function () {
    $.ajax({
      method: "POST",
      url: "tambah-barang",
      dataType: "json",
      data: {
        total: total,
        sawi: sawi,
      },
      success: function (res) {
        console.log(res);
      },
    });
  });
});

$(document).delegate("#dlt-brg", "click", function () {
  var barang = $(this).data("id");
  console.log(barang);
  Swal.fire({
    title: "are you oke bruh?",
    text: "data tidak bisa dikembalikan lagi",
    icon: "warning",
    confirmButtonText: "Yes",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Processing...", "", "", {
        showCancelButton: false,
        showConfirmButton: false,
      });
      $.ajax({
        url: "/delete/",
        type: "POST",
        dataType: "json",
        data: {
          id: barang,
        },
        success: function (res) {
          if (res.status == "ok") {
            Swal.fire({
              title: "Delete Success",
              icon: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            }).then(function () {
              location.reload(null, false);
            });
          } else {
            Swal.fire({
              title: "Delete Failed!",
              icon: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            });
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          Swal.fire({
            title: "Terjadi Kesalahan!",
            text: textStatus,
            icon: "error",
            showCancelButton: false,
            showConfirmButton: false,
            timer: 2000,
          });
        },
      });
    }
  });
});

// $(document).ready(function () {
//   $("#barang").click(function () {
//     $(".tmpl").toggle();
//   });
// });

$(document).ready(function () {
  $("#insert-stock").click(function () {
    $("#form").toggle();
  });
});

// =========================================

// $("#exampleModal").on("show.bs.modal", function (event) {
//   var button = $(event.relatedTarget); // Button that triggered the modal
//   var recipient = button.data("whatever"); // Extract info from data-* attributes
//   // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
//   // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
//   var modal = $(this);
//   modal.find(".modal-title").text("Tambah Stok Barang disini");
//   modal.find(".modal-body input").val();
// });

// tampilkan stok
$("#kirim").on("show.bs.modal", function (e) {
  var modal = $(this);
  $('#alias').on('change', function(){
    let alias = $(this).val();
    $.ajax({
      url: "/get/stok",
      type: "POST",
      dataType: "json",
      data: {
        alias: alias,
      },
      success: function (res) {
        let stok = res.qty;
        console.log(stok)
        qty = stok.replace(/[^,\d]/g, ",").toString()
        modal.find("#current_stock").text(qty);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        Swal.fire({
          title: "Terjadi Kesalahan!",
          text: textStatus,
          icon: "error",
          showCancelButton: false,
          showConfirmButton: false,
          timer: 2000,
        });
      },
    });
  })
});

$("#edit-stok").on("show.bs.modal", function (e) {
  var a = $(e.relatedTarget);
  var alias = a.data("alias");
  var stok = a.data("stok");
  var id = a.data("id");
  var modal = $(this);

  $("#myform").attr("action", "/edit/stok/" + id);
  modal.find(".alias").val(alias);
  modal.find(".stok").val(stok);
});

// edit barang
$("#edit-barang").on("show.bs.modal", function (e) {
  var a = $(e.relatedTarget);
  var id = a.data("id");
  var alias = a.data("alias");
  var qty = a.data("qty");
  var satuan = a.data("satuan");
  var created_by = a.data("created_by");
  var deskripsi = a.data("deskripsi");
  var modal = $(this);

  $("#formEdit").attr("action", "/edit/barang/" + id);
  modal.find(".alias").val(alias);
  modal.find(".qty").val(qty);
  modal.find(".satuan").val(satuan);
  modal.find(".created_by").val(created_by);
  modal.find(".deskripsi").val(deskripsi);
});

$("#exampleModal").on("show.bs.modal", function (event) {
  $(e.currentTarget).find('a[name="bookId"]').val(bookId);
  var button = $(event.relatedTarget); // Button that triggered the modal
  var recipient = button.data("whatever"); // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this);
  modal.find(".modal-title").text("New message to " + recipient);
  modal.find(".modal-body input").val(recipient);
});

// konfirmasi status sukses pada database pengiriman
$(document).delegate("#status-success", "click", function () {
  var status_id = $(this).data("id");
  // var status = $(this).data("status");
  console.log(status_id);
  Swal.fire({
    title: "Apakah pengiriman sudah selesai?",
    text: "",
    icon: "warning",
    confirmButtonText: "Yes",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Processing...", "", "", {
        showCancelButton: false,
        showConfirmButton: false,
      });
      $.ajax({
        url: "/status/pengiriman/" + status_id,
        type: "POST",
        dataType: "json",
        data: {
          id: status_id,
        },
        success: function (res) {
          if (res.status == "ok") {
            Swal.fire({
              title: "Barang Selesai Dikirimkan",
              icon: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            }).then(function () {
              location.reload(null, false);
            });
          } else {
            Swal.fire({
              title: "Delete Failed!",
              icon: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            });
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          Swal.fire({
            title: "Terjadi Kesalahan!",
            text: textStatus,
            icon: "error",
            showCancelButton: false,
            showConfirmButton: false,
            timer: 2000,
          });
        },
      });
    }
  });
});

$(document).delegate("#status-canceled", "click", function () {
  var status_id = $(this).data("id");
  var status_alias = $(this).data("alias");
  var status_qty = $(this).data("qty");
  var status_url = $(this).data("url");
  // var status = $(this).data("status");
  console.log(status_id);
  Swal.fire({
    title: "Apakah pengiriman akan dibatalkan?",
    text: "",
    icon: "warning",
    confirmButtonText: "Yes",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Processing...", "", "", {
        showCancelButton: false,
        showConfirmButton: false,
      });
      $.ajax({
        url: status_url,
        type: "POST",
        dataType: "json",
        data: {
          id: status_id,
          alias: status_alias,
          qty: status_qty,
        },
        success: function (res) {
          if (res.status == "ok") {
            Swal.fire({
              title: "Barang Barhasil Dibatalkan",
              icon: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            }).then(function () {
              location.reload(null, false);
            });
          } else {
            Swal.fire({
              title: "Delete Failed!",
              icon: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            });
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          Swal.fire({
            title: "Terjadi Kesalahan!",
            text: textStatus,
            icon: "error",
            showCancelButton: false,
            showConfirmButton: false,
            timer: 2000,
          });
        },
      });
    }
  });
});

// ========================== Rupiah ==================================

var rupiah = document.getElementById("rupiah");
rupiah.addEventListener("keyup", function (e) {
  // tambahkan 'Rp.' pada saat form di ketik
  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  rupiah.value = formatRupiah(this.value);
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? +rupiah : "";
}

//=========================================================== act done =============================================

// toggle barang
$(document).ready(function(){
  $("#btn").click(function(){
    // $(".operasi").attr("class", "box-btn btn btn-primary");
    $("#toggle").slideToggle()
  })
})

// barang dikirim
//  update status dan kurangi stok tanpa mengirim ke database laporan
$(document).delegate("#status-kirim", "click", function () {
  var id = $(this).data("id");
  // var status = $(this).data("status");
  console.log(id);
  Swal.fire({
    title: "Apakah barang akan dikirim?",
    text: "",
    icon: "warning",
    confirmButtonText: "Yes",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Processing...", "", "", {
        showCancelButton: false,
        showConfirmButton: false,
      });
      $.ajax({
        url: "/status/kirim/" + id,
        type: "POST",
        dataType: "json",
        data: {
          id: id,
        },
        success: function (res) {
          if (res.status == "ok") {
            Swal.fire({
              title: "Barang Berhasil Dikirimkan",
              icon: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            }).then(function () {
              location.reload(null, false);
            });
          } else {
            Swal.fire({
              title: "Delete Failed!", // validasi
              icon: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            });
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          Swal.fire({
            title: "Terjadi Kesalahan!", // controller
            text: textStatus,
            icon: "error",
            showCancelButton: false,
            showConfirmButton: false,
            timer: 2000,
          });
        },
      });
    }
  });
});

// edit lokasi
$("#edit-lokasi").on("show.bs.modal", function (e) {
  var a = $(e.relatedTarget);
  var nama = a.data("nama");
  var alamat = a.data("alamat");
  var id = a.data("id");
  var modal = $(this);

  $("#modal-lokasi").attr("action", "/edit/lokasi/" + id);
  modal.find(".nama").val(nama);
  modal.find(".alamat").val(alamat);
});

// delete lokasi
$(document).delegate("#delete-lokasi", "click", function () {
  var id = $(this).data('id');
  var url = $(this).data('url');
  // var status = $(this).data("status");
  console.log(id);
  Swal.fire({
    title: "Apakah lokasi penerima akan di hapus?",
    text: "",
    icon: "warning",
    confirmButtonText: "Yes",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Processing...", "", "", {
        showCancelButton: false,
        showConfirmButton: false,
      });
      $.ajax({
        url: "/delete/lokasi/"+id,
        type: "POST",
        dataType: "json",
        data: {
          id: id,
        },
        success: function (res) {
          if (res.status == "ok") {
            Swal.fire({
              title: "Lokasi telah di hapus",
              icon: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            }).then(function () {
              location.reload(null, false);
            });
          } else {
            Swal.fire({
              title: "Delete Failed!",
              icon: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            });
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          Swal.fire({
            title: "Terjadi Kesalahan!",
            text: textStatus,
            icon: "error",
            showCancelButton: false,
            showConfirmButton: false,
            timer: 2000,
          });
        },
      });
    }
  });
});

// delete user
$(document).delegate("#delete-user", "click", function () {
  var id = $(this).data("id");
  // var status = $(this).data("status");
  console.log(id);
  Swal.fire({
    title: "Apakah pengguna akan dihapus?",
    text: "",
    icon: "warning",
    confirmButtonText: "Yes",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Processing...", "", "", {
        showCancelButton: false,
        showConfirmButton: false,
      });
      $.ajax({
        url: "/delete/user/" + id,
        type: "POST",
        dataType: "json",
        data: {
          id: id,
        },
        success: function (res) {
          if (res.status == "ok") {
            Swal.fire({
              title: "Pengguna berhasil dihapus",
              icon: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            }).then(function () {
              location.reload(null, false);
            });
          } else {
            Swal.fire({
              title: "Delete Failed!",
              icon: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            });
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          Swal.fire({
            title: "Terjadi Kesalahan!",
            text: textStatus,
            icon: "error",
            showCancelButton: false,
            showConfirmButton: false,
            timer: 2000,
          });
        },
      });
    }
  });
});

function change() {
    
  // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
  var x = document.getElementById('myPassword').type;

  //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
  if (x == 'password') {

      //ubah form input password menjadi text
      document.getElementById('myPassword').type = 'text';
      
      //ubah icon mata terbuka menjadi tertutup
      document.getElementById('mata').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                      <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                      <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                      <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                      </svg>`;
  }
  else {

      //ubah form input password menjadi text
      document.getElementById('myPassword').type = 'password';

      //ubah icon mata terbuka menjadi tertutup
      document.getElementById('mata').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                      <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                      <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                      </svg>`;
  }
};

// edit user
$("#edit-user").on("show.bs.modal", function (e) {
  var a = $(e.relatedTarget);
  var name = a.data("name");
  var username = a.data("username");
  var password = a.data("password");
  var accessibility = a.data("accessibility");
  var id = a.data("id");
  var modal = $(this);

  $("#modal-user").attr("action", "/edit/user/" + id);
  modal.find(".name").val(name);
  modal.find(".username").val(username);
  modal.find(".password").val(password);
  modal.find(".accessibility").val(accessibility);
});

function change_icon() {
    
  // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
  var x = document.getElementById('pw').type;
  console.log(x); 

  //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
  if (x == 'password') {

      //ubah form input password menjadi text
      document.getElementById('pw').type = 'text';
      
      //ubah icon mata terbuka menjadi tertutup
      document.getElementById('eye').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                      <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                      <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                      <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                      </svg>`;
  }
  else {

      //ubah form input password menjadi text
      document.getElementById('pw').type = 'password';

      //ubah icon mata terbuka menjadi tertutup
      document.getElementById('eye').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                      <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                      <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                      </svg>`;
  }
};

function change() {
    
  // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
  var x = document.getElementById('pass').type;
  console.log(x); 


  //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
  if (x == 'password') {

      //ubah form input password menjadi text
      document.getElementById('pass').type = 'text';
      
      //ubah icon mata terbuka menjadi tertutup
      document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                      <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                      <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                      <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                      </svg>`;
  }
  else {

      //ubah form input password menjadi text
      document.getElementById('pass').type = 'password';

      //ubah icon mata terbuka menjadi tertutup
      document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                      <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                      <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                      </svg>`;
  }
};

$(document).delegate("#pen-success", "click", function () {
  var id = $(this).data("id");
  // var status = $(this).data("status");
  console.log(id);
  Swal.fire({
    title: "Apakah barang telah diterima?",
    text: "",
    icon: "warning",
    confirmButtonText: "Yes",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Processing...", "", "", {
        showCancelButton: false,
        showConfirmButton: false,
      });
      $.ajax({
        url: "/accept/penerimaan/"+id,
        type: "POST",
        dataType: "json",
        data: {
          id: id,
        },
        success: function (res) {
          if (res.status == "ok") {
            Swal.fire({
              title: "Tindakan telah dilakukan",
              icon: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            }).then(function () {
              location.reload(null, false);
            });
          } else {
            Swal.fire({
              title: "Delete Failed!", // validasi
              icon: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            });
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          Swal.fire({
            title: "Terjadi Kesalahan!", // controller
            text: textStatus,
            icon: "error",
            showCancelButton: false,
            showConfirmButton: false,
            timer: 2000,
          });
        },
      });
    }
  });
});
$(document).delegate("#cancel-pen", "click", function () {
  var id = $(this).data("id");
  // var status = $(this).data("status");
  console.log(id);
  Swal.fire({
    title: "Barang tidak jadi dikirimkan?",
    text: "",
    icon: "warning",
    confirmButtonText: "Yes",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Processing...", "", "", {
        showCancelButton: false,
        showConfirmButton: false,
      });
      $.ajax({
        url: "/cancel/penerimaan/"+id,
        type: "POST",
        dataType: "json",
        data: {
          id: id,
        },
        success: function (res) {
          if (res.status == "ok") {
            Swal.fire({
              title: "Tindakan telah dilakukan",
              icon: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            }).then(function () {
              location.reload(null, false);
            });
          } else {
            Swal.fire({
              title: "Delete Failed!", // validasi
              icon: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            });
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          Swal.fire({
            title: "Terjadi Kesalahan!", // controller
            text: textStatus,
            icon: "error",
            showCancelButton: false,
            showConfirmButton: false,
            timer: 2000,
          });
        },
      });
    }
  });
});

$(document).ready(function(){
  $("#e-pass").click(function(){
    $("#form-user").toggle();
  })
})