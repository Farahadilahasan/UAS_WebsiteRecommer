<?php
include_once("inc/configg.php");
include_once("headerweb.php");
session_start();
?>

<h3>Login Recommer</h3>

<div class="form-container">

<?php 
$Email      = "";
$Password   = "";
$err        = "";

if(isset($_POST['login'])){
    $Email      = $_POST['Email'];
    $Password   = $_POST['Password'];

    if($Email == '' or $Password == ''){
        $err .= "<li>Silakan masukkan semua data</li>";
    }else{
        $sql1   = "select * from members where email = '$Email'";
        $q1     = mysqli_query($koneksi,$sql1);
        $r1     = mysqli_fetch_array($q1);
        $n1     = mysqli_num_rows($q1);

        if($r1['Password'] != md5($Password) && $n1 >0 && $r1['Status'] == '1'){
            $err .= "<li>Password tidak sesuai</li>";
        }

        if($n1 < 1){
            $err .= "<li>Akun tidak ditemukan</li>";
        }
        if(empty($err)){
            // Jika tidak ada kesalahan, proses login
            $_SESSION['login_success_message'] = "Login berhasil. Selamat datang kembali, $Email!";
            header("Location: message_login.php");
            exit();
        }
        }
    }
?>
<?php
    if($err){
        echo "<div class='error'><ul class='pesan'>$err</ul></div>";
    } elseif (isset($_SESSION['login_success_message'])) {
        echo '<div class="sukses">' . $_SESSION['login_success_message'] . '</div>';
        unset($_SESSION['login_success_message']); 
    }
    ?>
<div class="form-message-wrapper">
<form action="login.php" method="POST">
    <table>
        <tr>
            <td class="label">Email</td>
            <td><input type="text" name="Email" class="input" value="<?php echo $Email?>"/></td>
        </tr>
        <tr>
            <td class="label">Password</td>
            <td><input type="Password" name="Password" class="input" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="login" value="Login" class="tbl-biru"/></td>
        </tr>
    </table>
</form>
