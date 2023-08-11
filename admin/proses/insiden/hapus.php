<?php
include '../../include/koneksi.php';
$no = $_GET["no"];
//mengambil id yang ingin dihapus

//jalankan query DELETE untuk menghapus data
$query = "DELETE FROM insiden WHERE no='$no' ";
$hasil_query = mysqli_query($db1, $query);

//periksa query, apakah ada kesalahan
if (!$hasil_query) {
    die("Gagal menghapus data: " . mysqli_errno($db1) .
        " - " . mysqli_error($db1));
} else {
    echo "<script>alert('Data berhasil dihapus.');window.location='../../index.php';</script>";
}
