<?php
include '../../include/upload_koneksi.php';
include '../../include/koneksi.php';

if (isset($_POST['simpan'])) {
    //path folder file yg disimpen
    $ekstensi_diperbolehkan  = array('png', 'jpg', 'jpeg');
    $no = $_POST['no'];
    //echo var_dump($_FILES['EditImages']['name']);
    //echo $_POST['delete'];
    $problem = $_POST['problem'];
    $solution = $_POST['solution'];
    // $images = $_FILES['EditImages']['name']; //Ambil Nama File
    if ($_FILES['EditImages']['name'] == "") {
        $images = $_POST['images'];
    } else {
        $images = $_FILES['EditImages']['name'];
    }
    $is_delete_images = $_POST['delete'];
    //echo $_POST['delete'];
    //die();
    $x = explode('.', $images); //Misahin String dengan . sebagai acuan pemisah
    $ekstensi = strtolower(end($x));  //Membuat String jadi lowercase

    $ukuran    = $_FILES['EditImages']['size']; //Ambil Ekstensi File
    $file_tmp  = $_FILES['EditImages']['tmp_name'];     //Ambil Nama file yg masih temporary
    //echo (file_exists($_FILES['EditImages']['tmp_name']) || is_uploaded_file($_FILES['EditImages']['tmp_name']));
    //die();

    if ((file_exists($_FILES['EditImages']['tmp_name']) || is_uploaded_file($_FILES['EditImages']['tmp_name'])) == 1) {
        //  echo "1. Masuk";
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) { //ngecek apakah ekstensi nya masuk di salah satu array $ekstensi_diperbolehkan
            //  echo "2. Lolos Ektensi";
            if ($ukuran < 1044070) {
                // echo "3. Lolos Ukuran";           //Ngecek apakah Ekstensi File dibawah 1044070 byte
                move_uploaded_file($file_tmp, $FolderPath . $images); //Code Buat Nyimpen File di path yg ditentukan

            } elseif ($ukuran > 1044070) {
                // echo "3. Enggak Lolos Ukuran";
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

    // echo $is_delete_images;
    if ($is_delete_images == 'true') {
        echo 'kedelte';
        $dlt = mysqli_query($db1, "UPDATE insiden SET images = '' WHERE no= '$no' ");
    }
    //  echo $images;
    $sql = mysqli_query($db1, "UPDATE insiden SET problem='" . $problem . "', solution='" . $solution . "', images ='" . $images . "' WHERE no= '$no' ");
    // echo $images;
    // die();

    echo "
                                                    <script>
                                                    alert('Data Berhasil Diubah');
                                                    document.location.href = '../../index.php';
                                                    </script>";
    die();
}
