<?php
session_start();

include 'koneksi.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = mysqli_query($db1, "SELECT * FROM tb_user WHERE username = '" . $username . "'");
    if (mysqli_num_rows($login) > 0) {
        $d = mysqli_fetch_object($login);
        if (md5($password) == $d->password) {
            $_SESSION['status_login']   = true;
            $_SESSION['uno']            = $d->no;
            $_SESSION['uname']          = $d->username;

            echo "<script>window.location = '../index.php'</script>";
        } else {
            echo '<div class="alert alert-error">Password Salah</div>';
        }

        // CEK DATA NAMA DARI DB
        // echo $d->nama;
    } else {
        echo '<div class="alert alert-error">Username Tidak Ditemukan</div>';
    }


    // CARA DEBUG SQL
    // echo mysqli_num_rows($sql);
}


<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = md5($_POST['password']);


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($db1, "SELECT * FROM tb_user where username='$username' and password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
// echo $cek;
// die();
// cek apakah username dan password di temukan pada database
if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);

    // cek jika user login sebagai admin
    if ($cek > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['status'] = "login";
        //header("location:../../index.php");
        echo "<script>
				alert('Anda Berhasil Login');
                window.location.href = '../index.php';
			  </script>";
    } else {
        //header("location:../../index.php?pesan=gagal");
        echo "<script>
				alert('Failure');
                window.location.href = '../index.php';
			  </script>";
    }
}

