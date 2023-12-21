<?php include("header.php")?>
<?php
$sukses = "";
$katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1   = "DELETE FROM halaman WHERE id = '$id'";
    $q1     = mysqli_query($koneksi, $sql1);

    if ($q1) {
        $sukses = "Berhasil hapus data";
    }
}
?>
<h1>Halaman Admin</h1>
<p>
    <a href="add_data.php">
        <input type="button" class="btn btn-primary" value="Buat Halaman Baru"/>
    </a>
</p>

<?php
if ($sukses) {
?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
<?php
}
?>

<form class="row g-3" method="get">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Masukkan Kata Kunci" name="katakunci" value="<?php echo $katakunci?>"/>
    </div>
    <div class="col-auto">
        <input type="submit" name="cari" value="Cari Tulisan" class="btn btn-secondary"/>
    </div>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th class="col-1">#</th>
            <th>Kota</th>
            <th>Kategori</th>
            <th>Rekomendasi</th>
            <th>Deskripsi</th>
            <th class="col-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $sqltambahan = "";
    $per_halaman = 2;

    if ($katakunci != '') {
        $array_katakunci = explode(" ", $katakunci);
        for ($x = 0; $x < count($array_katakunci); $x++) {
            $sqlcari[] = "(kota LIKE '%" . $array_katakunci[$x] . "%' OR kategori LIKE '%" . $array_katakunci[$x] . "%' OR rekomendasi LIKE '%" . $array_katakunci[$x] . "%')";
        }
        $sqltambahan = " WHERE " . implode(" OR ", $sqlcari);
    }

    $sql1   = "SELECT * FROM halaman $sqltambahan";
    $page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $mulai  = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
    $q1     = mysqli_query($koneksi, $sql1);
    $total  = mysqli_num_rows($q1);
    $pages  = ceil($total / $per_halaman);
    $nomor  = $mulai + 1;
    $sql1   = $sql1 . " ORDER BY id DESC LIMIT $mulai,$per_halaman";

    $q1     = mysqli_query($koneksi, $sql1);

    while ($r1 = mysqli_fetch_array($q1)) {
    ?>
        <tr>
            <td><?php echo $nomor++ ?></td>
            <td><?php echo $r1['kota'] ?></td>
            <td><?php echo $r1['kategori'] ?></td>
            <td><?php echo $r1['rekomendasi'] ?></td>
            <td><?php echo $r1['deskripsi'] ?></td>
            <td>
                <a href="add_data.php?id=<?php echo $r1['id']?>"><span class="badge bg-warning text-dark">Edit</span></a>
                <a href="halaman.php?op=delete&id=<?php echo $r1['id'] ?>" onclick="return confirm('Apakah yakin mau hapus data bro?')"><span class="badge bg-danger">Delete</span></a>
            </td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>
<?php include("footer.php")?>
