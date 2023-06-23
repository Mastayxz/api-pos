<?php  
  session_start();
  if(!$_SESSION["ses_id_user"])
  header("location:./login.php");
?>
<html>
<head>
  <title>CRUD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<a href="logout.php" class="btn btn-danger float-right">logout</a>

<div class="jumbotron text-center">
<h1>Project CRUD</h1>
    <p>Selamat datang Admin   <?= $_SESSION['ses_nama'];?></p>
    <button id="btnInputBaru" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalInput">Input Baru</button>
</div>

<!-- Modal -->
<div class="modal fade" id="modalInput" tabindex="-1" role="dialog" aria-labelledby="modalInputLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input/Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" id="txtIDBarang">
          <div class="form-group">
            <label for="txtNamaBarang" class="col-form-label">Nama Barang</label>
            <input type="text" class="form-control" id="txtNamaBarang">
          </div>
          <div class="form-group">
            <label for="cboKategori" class="col-form-label">Kategori</label>
            <select class="form-control" id="cboKategori"></select>
          </div>
          <div class="form-group">
            <label for="txtHarga" class="col-form-label">Harga</label>
            <input type="input" class="form-control" id="txtHarga">
          </div>
          <div class="form-group">
            <label for="txtStok" class="col-form-label">Stok</label>
            <input type="input" class="form-control" id="txtStok">
          </div>
          <div class="form-group">
            <label for="txtCatatan" class="col-form-label">Catatan</label>
            <input type="text" class="form-control" id="txtCatatan">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button id="btnSimpan" type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>
  
<div class="container">
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="thead-dark">
      <tr>
        <th>#</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Catatan</th>
        <th>Action</th>
      </tr>
      </thead>
        <tbody id="tblShowData">

        </tbody>
    </table>
  </div>
</div>
  
</body>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/df-number-format/2.1.6/jquery.number.min.js"></script>
  <script type="text/javascript">
      function tampil_barang(){
          $.ajax({
            url: "http://localhost/api-pos/pos.php?cmd=tampil-barang",
            dataType: "json",
            success: function(hasil, status){
              // console.log(hasil)
              if(hasil.status == "OK"){
                var row = hasil.result;

                $('#tblShowData').html('');
                for (var i = 0; i<row.length; i++){
                  tr = $('<tr/>');
                  tr.append("<td style='text-align:right;'>" + (i+1)+".</td>");
                  tr.append("<td>"+row[i].nama_barang+"</td>");
                  tr.append("<td>"+row[i].nama_kategori+"</td>");
                  tr.append("<td>"+ $.number(row[i].harga)+"</td>");
                  tr.append("<td>"+row[i].stok+"</td>");
                  tr.append("<td>"+row[i].catatan+"</td>");

                  tr.append('<td class="text-nowrap"><button type="button" class="btn btn-sm btn-warning" onclick="edit(\''+row[i].id_barang+'\')">Edit</button> <button type="button" class="btn btn-sm btn-danger" onclick="hapus(\''+row[i].id_barang+'\')">Hapus</button></td> ');
                $('#tblShowData').append(tr);
                }
              }else{
                $('#tblShowData').html(result.message)
              }
            }
          });
      }

      function isicboKategori(){
        $.ajax({
          url: "http://localhost/api-pos/pos.php?cmd=data-kategori",
          contentType: false,
          cache:false,
          processData:false,
          success: function(hasil, status){
            if(hasil.status == "OK"){
              var row = hasil.result;
              $('#cboKategori').html('');
              $('#cboKategori').append('<optiom value="">-- Pilih Salah Satu --</option>')
              for(var i = 0 ; i<row.length ; i++){
                $('#cboKategori').append('<option value = "'+ row[i].id_kategori+'">'+row[i].nama_kategori + '</option>');
              }
            }
          }
        });
      }
      $('#btnInputBaru').click(function(e){
        e.preventDefault(
        );
        $('#txtIDBarang').val('')
        $('#txtNamaBarang').val('')
        $('#cboKategori').val('')
        $('#txtHarga').val('0')
        $('#txtStok').val('0')
        $('#txtCatatan').val('')
        $('#modalInput').modal({backdrop: 'static', keyboard:false})
      })

      $('#btnSimpan').click(function(e){
		  e.preventDefault();
      console.log("test");
		  if($('#txtNamaBarang').val().trim()==''){
		    alert('Nama barang masih kosong!');
		    return false;
		  }
		  if($('#cboKategori').val()==''){
		    alert('Kategori masih kosong!');
		    return false;
		  }

		  var formData = new FormData();
		    formData.append('id_barang',$('#txtIDBarang').val());
		    formData.append('nama_barang',$('#txtNamaBarang').val());
		    formData.append('id_kategori',$('#cboKategori').val());
		    formData.append('harga',$('#txtHarga').val());
		    formData.append('stok',$('#txtStok').val());
		    formData.append('catatan',$('#txtCatatan').val());
		    formData.append('aktif','1');

        $.ajax({
		    url: 'http://localhost/api-pos/pos.php?cmd=simpan-barang',
		    dataType: 'json',
		    type: 'post',
		    data: formData,
		    contentType: false,
		    cache: false,
		    processData: false,
		    success: function(hasil, status)  {
          console.log(hasil);
		      if(hasil.status=='OK'){
		        //BERHASIL
		        $('#modalInput').modal('hide');
		        tampil_barang();
		        return true;
		      }else{
		        alert('Data gagal disimpan!');
		      }
		    },
		    complete: function(xhr, desc, err) {
		      //COMPLETE
		    }
		  });
		  return false;
		});

    function hapus(id_barang) {
		  if (confirm("Hapus data?") == false) {
		    return;
		  }
		  var formData = new FormData();
		    formData.append('id_barang',id_barang);

		  $.ajax({
		    url: 'http://localhost/api-pos/pos.php?cmd=hapus-barang',
		    type: 'post',
		    data: formData,
		    contentType: false,
		    cache: false,
		    processData: false,
		    success: function(hasil, status) {
		      if(hasil.status=='OK'){
		        //BERHASIL
		        $('#modalInput').modal('hide');
		        tampil_barang();
		      }else{
		        alert(hasil.message);
		      }
		    },
		    complete: function(xhr, desc, err) {
		      //COMPLETE
		    }
		  });
		  return false;
		}

    function edit(id_barang) {
		  var formData = new FormData();
		    formData.append('id_barang',id_barang);

		  $.ajax({
		    url: 'http://localhost/api-pos/pos.php?cmd=edit',
		    dataType: 'json',
		    type: 'post',
		    data: formData,
		    processData: false,
		    contentType: false,
		    cache: false,
		    success: function(hasil, status) {
		      //console.log(hasil);
		      if(hasil.status=='OK'){
		        //BERHASIL
		        $("#txtIDBarang").val(hasil.id_barang);
		        $("#cboKategori").val(hasil.id_kategori);
		        $("#txtNamaBarang").val(hasil.nama_barang);
		        $('#txtHarga').val(hasil.harga);
		        $('#txtStok').val(hasil.stok);
		        $('#txtCatatan').val(hasil.catatan);
		        $('#modalInput').modal({backdrop: 'static', keyboard: false});
		      }else{
		        alert('Data not found!');
		      }
		    }

		  });
		}






      $(document).ready(function($){
        tampil_barang();
        isicboKategori();

      });

      
      
      

  </script>
</html>
