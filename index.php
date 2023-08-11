<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="background:#C6E5F0;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>

<div class="container">
    <h2 align="center" style="margin: 30px;">BANK KNOWLEDGE IM</h2>
    <?php
    $s_problem = "";
    $s_keyword = "";
    if (isset($_POST['search'])) {
        $s_problem = $_POST['s_problem'];
        $s_keyword = $_POST['s_keyword'];
    }
    ?>
    <form method="POST" action="">
        <div class="row mb-3">
            <div class="col-sm-12">
                <h4>Cari</h4>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <select name="s_problem" id="s_problem" class="form-control">
                        <option value="">Filter Problem</option>
                        <option value="EDC" <?php if ($s_problem == "EDC") {
                                                echo "selected";
                                            } ?>>EDC</option>
                        <option value="Loyalty" <?php if ($s_problem == "Loyalty") {
                                                    echo "selected";
                                                } ?>>Loyalty</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="text" placeholder="Keyword" name="s_keyword" id="s_keyword" class="form-control" value="<?php echo $s_keyword; ?>">
                </div>
            </div>
            <div class="col-sm-4">
                <button id="search" name="search" class="btn btn-warning">Cari</button>
                <a type="button" class="btn btn-primary plus mr-auto " class="text-right" style="float: right;" href="admin/login.php">LOGIN</a>
                </button>
            </div>
        </div>
    </form>

    <table class="table table-striped table-bordered" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <!-- <td>No</td> -->
                <td style="font-family: ui-rounded;" class="blockquote text-center">Problems</td>
                <td style="font-family: ui-rounded;" class="blockquote text-center">Solutions</td>
                <td style="font-family: ui-rounded;" class="blockquote text-center">Images</td>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'koneksi.php';
            $Port =  'http://localhost/';
            $base_url = $Port . 'incident/';
            $PathFolder = 'admin/proses/insiden/Upload/';
            $search_problem = "'%" . $s_problem . "%'";
            $search_keyword =  "'%" . $s_keyword . "%'";
            $no = 1;
            $current_page = 1;
            $dataInOnePage = 5;

            $query = "SELECT * FROM insiden WHERE problem LIKE " . $search_problem . " AND (problem LIKE " . $search_keyword . " OR solution LIKE " . $search_keyword . ") ORDER BY no ASC LIMIT " . $dataInOnePage;

            if (isset($_GET['page'])) {
                if ($_GET['page'] > 1) {
                    $current_page = $_GET['page'];
                    $offset = ($current_page - 1) * $dataInOnePage;
                    $query = $query . " OFFSET " . $offset . ";";
                }
            }
            // echo $query;
            // die();
            $countRow = $db1->prepare("select * from insiden");
            $countRow->execute();
            $resCount = $countRow->get_result();
            $totalRow = $resCount->num_rows;

            $incident = $db1->prepare($query);
            $incident->execute();
            $res1 = $incident->get_result();

            if ($res1->num_rows > 0) {
                while ($row = $res1->fetch_assoc()) {
                    // $no = $row['no'];
                    $problem = $row['problem'];
                    $solution = $row['solution'];
                    $images = $row['images'];
            ?>
                    <tr>
                        <!-- <td><?php echo $no++; ?></td> -->
                        <td><?php echo $problem; ?></td>
                        <td><?php echo $solution; ?></td>
                        <?php
                        if ($row['images'] != '') { ?>
                            <td>
                                <img src="<?php echo $base_url . $PathFolder . $row['images']; ?>" width="250" height="250">
                            </td>
                        <?php
                        } else {
                        ?>
                            <td class="text-center">Image Not Found</td>
                        <?php
                        }
                        ?>
                    </tr>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan='7'>Tidak ada data ditemukan</td>
                </tr>
            <?php } ?>

        </tbody>

    </table>
    <nav aria-label="">
        <ul class="pagination justify-content-center">
            <?php
            $totalPage = ceil($totalRow / $dataInOnePage);
            if ($current_page == 1) {
           
            }
            ?>

            
            <?php
            $PageLimitShow = 12;
             if($current_page < ($totalPage - ceil($PageLimitShow / 2)))
             {
                 $PageStart = $current_page <= ceil($PageLimitShow / 2) ? 1 : $current_page - ceil($PageLimitShow / 2);
                 $PageEnd = $totalPage < $PageLimitShow ? $totalPage :  $PageStart + ($PageLimitShow -1);
             }
             else{
                 $PageStart = $totalPage - $PageLimitShow;
                 $PageEnd =$totalPage;
             }
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

             <?php for ($i = $PageStart; $i <= $PageEnd; $i++) {
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