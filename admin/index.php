<!doctype html>
<html lang="en">

<?php
// mengaktifkan session


include 'partial/header.php';
?>

<body>
    <?php
    include 'partial/navbar.php';
    ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                    <span data-feather="calendar"></span>
                    This week
                </button>
            </div>
        </div> -->

        <h2>Bank Knowledge Incident</h2>
        <div class="table-responsive">
            <a type="button" class="btn btn-info" href="page/insiden/tambah.php">Add</a>
            <a type="button" class="btn btn-info" href="page/insiden/upload.php">Import</a>
            <a type="button" class="btn btn-info" href="page/insiden/export_excel.php" target="_blank">Export</a>

            <?php
            if (isset($_GET['berhasil'])) {
                echo "<p>" . $_GET['berhasil'] . " Data berhasil di import.</p>";
            }
            ?>
            <p>
            <table class="table table-striped table-lg">
                <thead>
                    <tr>
                        <!-- <th style="font-family: ui-rounded;" class="blockquote text-center">No.</th> -->
                        <th style="font-family: ui-rounded;" class="blockquote text-center">Problems</th>
                        <th style="font-family: ui-rounded;" class="blockquote text-center">Solutions</th>
                        <th style="font-family: ui-rounded;" class="blockquote text-center">Images</th>
                        <th style="font-family: ui-rounded;" class="blockquote text-center col-md-2" class="aksi">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'include/koneksi.php';
                    $Port =  'http://localhost/';
                    $base_url = $Port . 'incident/';
                    $PathFolder = 'admin/proses/insiden/Upload/';

                    //$no = 1;
                    //$sql = mysqli_query($db1, "select * from insiden");

                    $no = 1;
                    $current_page = 1;
                    $dataInOnePage = 5;

                    $query = "SELECT * FROM insiden ORDER BY no ASC LIMIT " . $dataInOnePage;

                    if (isset($_GET['page'])) {
                        if ($_GET['page'] > 1) {
                            $current_page = $_GET['page'];
                            $offset = ($current_page - 1) * $dataInOnePage;
                            $query = $query . " OFFSET " . $offset . ";";
                        }
                    }
                    // echo $query;
                    //         die();
                    $countRow = $db1->prepare("select * from insiden");
                    $countRow->execute();
                    $resCount = $countRow->get_result();
                    $totalRow = $resCount->num_rows;

                    $incident = $db1->prepare($query);
                    $incident->execute();
                    $res1 = $incident->get_result();

                    //while ($data = mysqli_fetch_assoc($sql)) {
                    while ($data = $res1->fetch_assoc()) {
                        //echo $PathFolder . $data['images'];
                    ?>
                        <tr>
                            <!-- <td><?php echo $no++; ?></td> -->
                            <td><?php echo $data['problem']; ?></td>
                            <td><?php echo $data['solution']; ?></td>
                            <?php if ($data['images'] != '') {        ?>
                                <td><img src="<?php echo $base_url . $PathFolder . $data['images']; ?>" width="250" height="250"></td>
                            <?php
                            } else {
                            ?>
                                <td class="text-center">Image Not Found</td>
                            <?php
                            }
                            ?>
                            <td class="text-center">
                                <a type="button" class="btn btn-primary btn-md lg-2" href="page/insiden/edit.php?no=<?php echo $data['no']; ?>">Update</a>

                                <a onclick="return confirm('Apakah anda yakin ingin menghapus data?')" type="button" class="btn btn-danger btn-md" href="proses/insiden/hapus.php?no=<?php echo $data['no']; ?>">Delete</a>
                            </td>
                            <!-- <td><a type="button" class="btn btn-primary btn-sm my-2 mx-1" href="page/insiden/edit.php?no=<?php echo $data['no']; ?>">Update</a><a onclick="return confirm('Apakah anda yakin ingin menghapus data?')" type="button" class="btn btn-danger btn-sm my-2 mx-1" href="proses/insiden/hapus.php?no=<?php echo $data['no']; ?>">Delete</a></td> -->
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <nav aria-label="">
                <ul class="pagination justify-content-center">
                    <?php
                    $totalPage = ceil($totalRow / $dataInOnePage);
                    if ($current_page == 1) {
                    ?>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                    <?php
                    } else { ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $current_page - 1 ?>" tabindex="-1">Previous</a>
                        </li>
                    <?php
                    }
                    ?>

                    <?php for ($i = 1; $i <= $totalPage; $i++) {
                        if ($i == $current_page) {
                    ?>
                            <li class="page-item active"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php
                        }
                    }
                    ?>
                    <?php
                    if ($current_page == $totalPage) {
                    ?>
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    <?php
                    } else { ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $current_page + 1 ?>">Next</a>
                        </li>
                    <?php
                    }

                    ?>


                </ul>
            </nav>

        </div>
    </main>
    </div>
    </div>
    <?php
    include 'partial/script.php';
    ?>
</body>

</html>