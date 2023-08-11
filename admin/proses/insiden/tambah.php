<?php
include '../../include/upload_koneksi.php';
include '../../include/koneksi.php';

/*$Port =  'http://localhost/';
$base_url = $Port . 'incident/';
$FolderPath = $base_url . 'admin/proses/insiden/Upload/';*/

if (isset($_POST['simpan'])) {
    //path folder file yg disimpen
    $ekstensi_diperbolehkan    = array('png', 'jpg', 'jpeg');

    $problem = $_POST['problem'];
    $solution = $_POST['solution'];
    $images = $_FILES['uploadImages']['name']; //Ambil Nama File

    $x = explode('.', $images); //Misahin String dengan . sebagai acuan pemisah
    $ekstensi = strtolower(end($x));  //Membuat String jadi lowercase
    echo $ekstensi;
    $ukuran    = $_FILES['uploadImages']['size']; //Ambil Ekstensi File

    $file_tmp = $_FILES['uploadImages']['tmp_name'];     //Ambil Nama file yg masih temporary
    if ($file_tmp != '' || $file_tmp != NULL) {

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) { //ngecek apakah ekstensi nya masuk di salah satu array $ekstensi_diperbolehkan
            if ($ukuran < 1044070) {            //Ngecek apakah Ekstensi File dibawah 1044070 byte
                move_uploaded_file($file_tmp, $FolderPath . $images); //Code Buat Nyimpen File di path yg ditentukan
            } elseif ($ukuran > 1044070) {
                echo "<script>
            alert('UKURAN FILE TERLALU BESAR')
            document.location.href = '../../index.php';
            </script>";
                die();
            }
        } else {
            echo "<script>alert('EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN')
        document.location.href = '../../index.php';
        </script>";
            die();
        }
    }

    $cekData = mysqli_num_rows(mysqli_query($db1, "SELECT * FROM insiden WHERE problem='$problem' OR solution='$solution'"));
    if ($cekData > 0) {
        echo "<script>
            alert('Terdapat Double Data!');
            document.location.href = '../../index.php';
            </script>";
    } else {
        mysqli_query($db1, "INSERT INTO insiden (problem, solution, images) VALUES ('$problem', '$solution', '$images')");
        echo "
                <script>
                alert('Data Berhasil Ditambahkan');
                document.location.href = '../../index.php';
                </script>";
    }
}
