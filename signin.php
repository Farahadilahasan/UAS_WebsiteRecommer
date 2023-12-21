<?php
include_once("inc/configg.php");
include_once("inc/fungsi.php");
include_once("headerweb.php");
?>

<h3>Sign In</h3>

<div class="form-container">

    <?php
    $Email = "";
    $Nama_lengkap = "";
    $Password = "";
    $Status = "";
    $err = "";
    $sukses = "";

    if (isset($_POST['simpan'])) {
        $Email = $_POST['Email'];
        $Nama_lengkap = $_POST['Nama_lengkap'];
        $Password = $_POST['Password'];
        $Konfirmasi_password = $_POST['Konfirmasi_password'];

        if ($Email == '' or $Nama_lengkap == '' or $Konfirmasi_password == '' or $Password == '') {
            $err .= "<li>Silakan masukkan semua isian.</li>";
        }

        // cek di bagian db, apakah Email sudah ada atau belum
        if ($Email != '') {
            $sql1 = "select Email from members where Email = '$Email'";
            $q1 = mysqli_query($koneksi, $sql1);
            $n1 = mysqli_num_rows($q1);
            if ($n1 > 0) {
                $err .= "<li>Email yang kamu masukkan sudah terdaftar.</li>";
            }

            // validasi Email
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                $err .= "<li>Email yang kamu masukkan tidak valid.</li>";
            }
        }

        // cek kesesuaian password & konfirmasi password
        if ($Password != $Konfirmasi_password) {
            $err .= "<li>Password dan Konfirmasi Password tidak sesuai.</li>";
        }
        if (strlen($Password) < 6) {
            $err .= "<li>Panjang karakter yang diizinkan untuk password paling tidak 6 karakter.</li>";
        }

        if (empty($err)) {
            $PasswordHash = md5($Password); 
            $sql1 = "INSERT INTO members(Email,Nama_lengkap,Password,Status) VALUES ('$Email','$Nama_lengkap','$PasswordHash','$Status')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Proses Berhasil. Silakan cek Email kamu untuk verifikasi.";
            } else {
                $err .= "<li>Gagal mengeksekusi query: " . mysqli_error($koneksi) . "</li>";
            }
        }
    }
    ?>
    <div class="form-message-wrapper">
        <?php if ($err) {
            echo "<div class='error'><ul>$err</ul></div>";
        } ?>
        <?php if ($sukses) {
            echo "<div class='sukses'>$sukses</div>";
        } ?>

<form action="signin.php" method="POST">
    <table>
        <tr>
            <td class="label">Email</td>
            <td>
                <input type="text" name="Email" class="input" value="<?php echo $Email?>"/>
            </td>
        </tr>
        <tr>
            <td class="label">Nama Lengkap</td>
            <td>
                <input type="text" name="Nama_lengkap" class="input" value="<?php echo $Nama_lengkap?>"/>
            </td>
        </tr>
        <tr>
            <td class="label">Password</td>
            <td>
                <input type="Password" name="Password" class="input" />
            </td>
        </tr>
        <tr>
            <td class="label">Konfirmasi Password</td>
            <td>
                <input type="Password" name="Konfirmasi_password" class="input" />
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="simpan" value="simpan" class="tbl-biru"/>
            </td>
        </tr>
    </table>
</form>