<?php
include '../../../koneksi.php';
include 'excel_reader2.php';
?>

<?php
// upload file xlsx
$target = basename($_FILES['fileinsiden']['name']);
move_uploaded_file($_FILES['fileinsiden']['tmp_name'], $target);

// permissions
chmod($_FILES['fileinsiden']['name'], 0777);

// mengambil data
$data = new Spreadsheet_Excel_Reader($_FILES['fileinsiden']['name'], false);
// menghitung jumlah data
$jumlah_baris = $data->rowcount($sheet_index = 0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i = 4; $i <= $jumlah_baris; $i++) {
    // menangkap data dan masukkan ke dalam variabel
    $no = $data->val($i, 1);
    $problem = $data->val($i, 2);
    $solution = $data->val($i, 3);
    $images = $data->val($i, 4);

    $cekData = mysqli_num_rows(mysqli_query($db1, "SELECT * FROM insiden WHERE no='$no' OR problem='$problem' OR solution='$solution' OR images='$images'"));
    if ($cekData > 0) {
        echo "<script>
                alert('Terdapat Double Data!');
                document.location.href = '../../index.php';
                </script>";
    } else if ($problem != "" && $solution != "") {
        // input data
        mysqli_query($db1, "INSERT INTO insiden VALUES ('$problem', '$solution', '$images')");
        $berhasil++;
    }
}

// hapus file yang sudah di upload
unlink($_FILES['fileinsiden']['name']);

// alihkan halaman
header("location:../../index.php?berhasil=$berhasil");

?>