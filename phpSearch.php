<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/2cd128de6a.js" crossorigin="anonymous"></script>
    <title>Display with Search</title>
</head>
<body>
    <?php

    require_once "dbConnect.php";

    $search = $_POST['search'];

    $tsql= "SELECT * FROM [dbo].[Student] WHERE FristName LIKE '%$search%' OR LastName LIKE '%$search%'";
    $getResults= sqlsrv_query($conn, $tsql);

    if ($getResults == FALSE) {
        echo (sqlsrv_errors());
    }
    ?>
    <div class="container mt-5">

        <form action="" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control form-control-lg" placeholder="Search Here" name="search">
                <button type="submit" class="input-group-text btn-primary"><i class="fa-solid fa-magnifying-glass me-2"></i></i> Search</button>
            </div>
        </form>

        <div class="card">
            <div class="card-header">
                <h5>ค้นหาด้วย " <?php echo $search?> "</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover table-primary">
                    <thead class="table-dark">
                        <tr>
                            <td scope="col" class="text-center">รหัสนักศึกษา</td>
                            <td scope="col" class="text-center">ชื่อ</td>
                            <td scope="col" class="text-center">นามสกุล</td>
                            <td scope="col" class="text-center">ตำบล</td>
                            <td scope="col" class="text-center">จังหวัด</td>
                            <td scope="col" class="text-center">ภาค</td>
                            <td scope="col" class="text-center"> เเก้ไข </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count_id = 1;
                        while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <th scope="row" class="text-end"><?php echo $row['StudentID']; ?></th>
                                <td class="text-center fs-6"><?php echo $row['FristName']; ?></td>
                                <td class="text-center fs-6"><?php echo $row['LastName']; ?></td>
                                <td class="text-center fs-6"><?php echo $row['District']; ?></td>
                                <td class="text-center fs-6"><?php echo $row['Province']; ?></td>
                                <td class="text-center fs-6"><?php echo $row['Region']; ?></td>
                                <td class="text-center fs-6" id="<?php echo $count_id;?>"></td>
                            </tr>
                        <?php
                            $count_id += 1;
                        }
                        sqlsrv_free_stmt($getResults);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script></script>
</body>
</html>