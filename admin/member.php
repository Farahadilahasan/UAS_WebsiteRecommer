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
    $sql1   = "DELETE FROM members WHERE id = '$id'";
    $q1     = mysqli_query($koneksi, $sql1);

    if ($q1) {
        $sukses = "Berhasil hapus data";
    }
}
?>
<h1>Members Admin</h1>

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
        <input type="submit" name="cari" value="Cari Members" class="btn btn-secondary"/>
    </div>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th class="col-1">#</th>
            <th>Email</th>
            <th>Nama</th>
            <th class="col-2">Status</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $sqltambahan = "";
    $per_members = 2;

    if ($katakunci != '') {
        $array_katakunci = explode(" ", $katakunci);
        for ($x = 0; $x < count($array_katakunci); $x++) {
            $sqlcari[] = "(Nama_lengkap LIKE '%" . $array_katakunci[$x] . "%' OR Email LIKE '%" . $array_katakunci[$x]. "%')";
        }
        $sqltambahan = " WHERE " . implode(" OR ", $sqlcari);
    }

    $sql1   = "SELECT * FROM members $sqltambahan";
    $page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $mulai  = ($page > 1) ? ($page * $per_members) - $per_members : 0;
    $q1     = mysqli_query($koneksi, $sql1);
    $total  = mysqli_num_rows($q1);
    $pages  = ceil($total / $per_members);
    $nomor  = $mulai + 1;
    $sql1   = $sql1 . " ORDER BY id DESC LIMIT $mulai,$per_members";

    $q1     = mysqli_query($koneksi, $sql1);

    while ($r1 = mysqli_fetch_array($q1)) {
    ?>
        <tr>
            <td><?php echo $nomor++ ?></td>
            <td><?php echo $r1['Email'] ?></td>
            <td><?php echo $r1['Nama_lengkap'] ?></td>
            <td>
               <?php 
               if($r1['Status']== '1'){
                    ?>
                    <span class="badge bg-success">Aktif</span>
                    <?php
               }else{
                    ?>
                    <span class="badge bg-light text-dark">Belum Aktif</span>
                    <?php
               }
               ?>
            </td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>
<?php include("footer.php")?>
