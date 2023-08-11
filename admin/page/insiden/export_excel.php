<?php
include '../../../koneksi.php';
?>
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Insiden.xls");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Excel</title>

    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;
        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>No.</th>
            <th>Problems</th>
            <th>Solutions</th>
            <th>Images</th>
        </tr>
        <?php
        $Port =  'http://localhost/';
        $base_url = $Port . 'incident/';
        $PathFolder = 'admin/proses/insiden/Upload/';
        $data = mysqli_query($db1, "SELECT * FROM insiden");
        $no = 1;
        while ($d = mysqli_fetch_assoc($data)) {
        ?>
            <tr>
                <td class="width=" 250" height="250"><?= $d['no']; ?></td>
                <td class="width=" 250" height="250"><?= $d['problem']; ?></td>
                <td class="width=" 250" height="250"><?= $d['solution']; ?></td>
                <?php if ($d['images'] != '') { ?>
                    <td><img src="<?php echo $base_url . $PathFolder . $d['images']; ?>" width="250" height="250"></td>
                <?php
                } else {
                ?>
                    <td class="text-center" width="250" height="250">Image Not Found</td>
                <?php
                }
                ?>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>