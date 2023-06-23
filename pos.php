    <?php 

    // header untuk cors policy 
    header('Access-Control-Allow-Oarigin');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Methods: PUT, GET, POST, HEAD, DELETE, OPTIONS');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Content-Type: application/json; charset=utf-8');

    require_once('koneksi.php');
    if(isset($_GET['cmd'])){
        $cmd = $_GET['cmd'];
    }else {
        $arrData = array();
        $arrResult = array(
            'status' => 'FAILED',
            'message' => 'Perintah kosong'
        );
        $json_decode = json_encode($arrResult);
        echo $json_decode;
        exit;
    }

    switch ($cmd) {
        case 'tampil-barang':
            # code...
            // perintah tampil barang 
           $sql = "SELECT
                        *, k.nama_kategori
                        FROM
                            `pos_barang` b LEFT JOIN `pos_kategori` k
                            ON b.id_kategori = k.id_kategori
                        WHERE 
                            1=1";
            // jalankan sql
            $result = mysqli_query($koneksi, $sql);
            // jika barang tidak ditemukan 
            if(mysqli_num_rows($result)>0){
                // 
                $arrData = array();
                while($row = mysqli_fetch_assoc($result)){
                    $arrData[]= $row;
                }
                $arrResult = array (
                    'status' => 'OK',
                    'result' => $arrData
                );
            }else {
                $arrResult = array(
                    'status' => 'FAILED',
                    'message' => 'Data kosong'
                );
            }
            $json_decode = json_encode($arrResult);
            echo $json_decode;
         break;
        case 'simpan-barang';
            // perintah simpan barang
            $id_barang = $_POST['id_barang'];
            $id_kategori = $_POST['id_kategori'];
            $nama_barang = $_POST['nama_barang'];
            
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $catatan = $_POST['catatan'];
            $aktif = $_POST['aktif'];

           echo $sql = "SELECT * FROM `pos_barang` WHERE 1=1 
                    AND id_barang ='$id_barang'";
            
            // 
            $result = mysqli_query($koneksi, $sql);

            if (mysqli_num_rows($result)>0) {
                # code...
                // jika ada data ditemukan lakukan update 
               echo $sql = "UPDATE `pos_barang`
                        SET 
                            id_kategori = '$id_kategori'
                            nama_kategori = '$nama_kategori',
                            nama_barang = '$nama_barang',
                            harga = '$harga',
                            stok = '$stok',
                            catatan = '$catatan',
                            aktif = '$aktif'
                        WHERE 
                            id_barang = '$id_barang'

                        ";
                mysqli_query($koneksi, $sql);
                if(mysqli_affected_rows($koneksi)==1){
                    $arrResult = array(
                        'status' => 'OK',
                        'message' => 'Data berhasil di update'
                    );
                }else {
                    $arrResult = array(
                        'status' => 'FAILED',
                        'message' => 'Data kosong'
                    );
                                }
            }else {
                $sql = "INSERT `pos_barang`
                        SET 
                            id_kategori = '$id_kategori',
                            nama_barang = '$nama_barang',
                            harga = '$harga',
                            stok = '$stok',
                            catatan = '$catatan',
                            aktif = '$aktif'
                        ";

                mysqli_query($koneksi,$sql);
                if(mysqli_affected_rows($koneksi)==1){
                    $arrResult = array(
                        'status' => 'OK',
                        'message' => 'Data berhasil di input'
                    );
                }else {
                    $arrResult = array(
                        'status' => 'FAILED',
                        'message' => 'Data kosong'
                    );
                }
            }
            $json_decode = json_encode($arrResult);
            echo $json_decode;
        
            break;
        case 'hapus-barang';
            // perintah hapus barang 
            $id_barang = $_POST['id_barang'];

	        $sql = "SELECT
	        			*
	        		FROM
	        			`pos_barang`
	        		WHERE
	        			1=1
	        			AND id_barang='$id_barang'";
	        //Jalankan perintah sql
			$result = mysqli_query($koneksi, $sql);

			if(mysqli_num_rows($result)>0){
				//Jika ada data ditemukan, lakukan hapus
				$sql = "DELETE FROM
							`pos_barang`
						WHERE
							id_barang = '$id_barang'
						LIMIT 1
						";
				mysqli_query($koneksi, $sql);
				if(mysqli_affected_rows($koneksi)==1){
					$arrResult = array(
		                'status' => 'OK',
		                'result' => 'Data berhasil dihapus'
	            	);
	            }else{
	            	$arrResult = array(
		                'status' => 'FAILED',
		                'result' => 'Tidak ada data terhapus!'
	            	);
	            }
	        }else{
	        	$arrResult = array(
	                'status' => 'FAILED',
	                'result' => 'Data tidak ditemukan!'
            	);
	        }

	        //Rubah ke dalam bentuk json
            $json = json_encode($arrResult);
            echo $json;


            break;
        case 'edit';
        $id_barang = $_POST["id_barang"];

			$sql = "SELECT
						*
					FROM
						`pos_barang`
					WHERE
						id_barang = '$id_barang'
			";
	        $result = mysqli_query($koneksi, $sql);
	        if(mysqli_num_rows($result)>0){
	          $json_array = array();
	          $json_decode = "";
	          while($row = mysqli_fetch_array($result)){
	            $json_array = array(
	                'status' => 'OK',
	                'id_barang' => $row['id_barang'],
	                'id_kategori' => $row['id_kategori'],
	                'nama_barang' => $row['nama_barang'],
	                'harga' => $row['harga'],
	                'stok' => $row['stok'],
	                'catatan' => $row['catatan']
	            );
	            $json_decode = json_encode($json_array);
	          }
	          echo $json_decode;
	        }else{
	          echo '{"status":"FAIL","message":"Data not found!"}';
	        }
		
        break;

        // kategori
        case 'data-kategori';
        $sql = "SELECT * FROM `pos_kategori` WHERE 1=1";
        // jalankan sql
        $result = mysqli_query($koneksi, $sql);
        // jika barang tidak ditemukan 
        if(mysqli_num_rows($result)>0){
            // 
            $arrData = array();
            while($row = mysqli_fetch_assoc($result)){
                $arrData[]= $row;
            }
            $arrResult = array (
                'status' => 'OK',
                'result' => $arrData
            );
        }else {
            $arrResult = array(
                'status' => 'FAILED',
                'message' => 'Data kosong'
            );
        }
        $json_decode = json_encode($arrResult);
        echo $json_decode;
        break;
        default:
            // peintah tidak ditemukan
        $arrData = array();
         $arrResult = array(
            'status' => 'FAILED',
            'message' => 'Perintah kosong'
        );
        $json_decode = json_encode($arrResult);
        echo $json_decode;
        exit;
            break;
    }


    ?>