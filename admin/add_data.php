<?php include("header.php") ?>
<?php
$kota       = "";
$kategori   = "";
$rekomendasi= "";
$deskripsi  = "";
$error      = "";
$sukses     = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = "";
}

if($id != ""){
    $sql1   = "SELECT * FROM halaman WHERE id = '$id'";
    $q1     = mysqli_query($koneksi, $sql1);
    $r1     = mysqli_fetch_array($q1);
    $kota   = $r1['kota'];  // Ganti sesuai kolom yang sesuai dengan kota pada tabel
    $kategori   = $r1['kategori'];  // Ganti sesuai kolom yang sesuai dengan kategori pada tabel
    $rekomendasi    = $r1['rekomendasi'];  // Ganti sesuai kolom yang sesuai dengan rekomendasi pada tabel
    $deskripsi    = $r1['deskripsi'];  // Ganti sesuai kolom yang sesuai dengan deskripsi pada tabel

    if($rekomendasi == ''){
        $error  = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $kota       = $_POST['kota'];  // Ganti sesuai dengan input kota pada form
    $kategori   = $_POST['kategori'];  // Ganti sesuai dengan input kategori pada form
    $rekomendasi= $_POST['rekomendasi'];
    $deskripsi  = $_POST['deskripsi'];

    if ($kota == '' or $kategori == '' or $rekomendasi == '' or $deskripsi == '') {
        $error     = "Silakan masukkan semua data, yakni kota, kategori, rekomendasi, dan deskripsi.";
    }

    if (empty($error)) {
        if($id != ""){
            $sql1   = "UPDATE halaman SET kota = '$kota', kategori = '$kategori', rekomendasi = '$rekomendasi', deskripsi = '$deskripsi'";
        }else{
            $sql1   = "INSERT INTO halaman(kota, kategori, rekomendasi, deskripsi) VALUES ('$kota', '$kategori', '$rekomendasi', '$deskripsi')";
        }

        $q1         = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $sukses     = "Sukses memasukkan data";
        } else {
            $error      = "Gagal memasukkan data";
        }
    }
}
?>
<h1>Halaman Admin Input Data</h1>
<div class="mb-3 row">
    <a href="halaman.php">
        << Kembali ke halaman admin</a>
</div>
<?php
if ($error) {
?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error ?>
    </div>
<?php
}
?>
<?php
if ($sukses) {
?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
<?php
}
?>
<form action="" method="post">
    <div class="mb-3 row">
        <label for="kota" class="col-sm-2 col-form-label">Kota</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="kota" value="<?php echo $kota ?>" name="kota">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="kategori" value="<?php echo $kategori ?>" name="kategori">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="rekomendasi" class="col-sm-2 col-form-label">Rekomendasi</label>
        <div class="col-sm-10">
            <textarea name="rekomendasi" class="form-control" id="summernote"><?php echo $rekomendasi ?></textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
        <div class="col-sm-10">
            <textarea name="deskripsi" class="form-control" id="summernote"><?php echo $deskripsi ?></textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
        </div>
    </div>
</form>
<?php include("footer.php") ?>
