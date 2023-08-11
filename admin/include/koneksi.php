<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "db_insiden";
$db1 = mysqli_connect($db_host, $db_username, $db_password, $db_name);
if (!$db1) {
    die("Koneksi Error : Silakan cek kembali " . mysqli_connect_error());
}
