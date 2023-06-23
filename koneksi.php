<?php 

$koneksi = mysqli_connect('localhost', 'root', '', 'pos');

if (!$koneksi){
    die("koneksi gagal: ". mysqli_connect_error());
}
?>