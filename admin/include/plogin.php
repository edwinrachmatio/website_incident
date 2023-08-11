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
// if ($cek > 0) {
//     $data = mysqli_fetch_assoc($login);

// cek jika user login sebagai admin
if ($cek > 0) {
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['status'] = "login";
    //header("location:../../index.php");
    echo "<script>
				alert('success');
                window.location.href = '../index.php';
			  </script>";
} else {
    //header("location:../../index.php?pesan=gagal");
    echo "<script>
				alert('Failure');
                window.location.href = '../login.php';
			  </script>";
    die();
}
