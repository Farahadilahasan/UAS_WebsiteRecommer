<?php
$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "recommer";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if(!$koneksi){
    die("Gagal Terkoneksi");
}else{
    echo "Koneksi Berhasil";
}
