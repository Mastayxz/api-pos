<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button id="btnTampilBarang">Tampil Barang</button>
    <div id="divHasil"></div>
</body>
     <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script>
     $("#btnTampilBarang").click(function(e){
        e.preventDefault();

        $.ajax({
               url: `http://localhost/api-pos/pos.php?cmd=tampil-barang`,
               dataType: 'json',
               success: function(hasil, status){
                
                if(hasil.status == 'OK'){
                    var row = hasil.result;
                    console.log(row);
                    $('#divHasil').html('');
                    for(var i = 0; i<row.length; i++){
                        data_hasil = '';
                        data_hasil += (i+1) + '. ';
                        data_hasil += row[i].nama_barang;
                        data_hasil += '<br>';
                        $('#divHasil').append(data_hasil);
                    }
                }else{
                    $('#divHasil').html(result.message);
                }
               }
            });
         });
    
     
    </script>
        
</html>