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
    <link rel="stylesheet" href="css/style.css">
    <title>Display with Search</title>
</head>
<body>
    <?php

    $search = $_POST['search'];

    $serverName = "myosproject.database.windows.net"; 
    $connectionOptions = array(
        "Database" => "myosproject", 
        "Uid" => "osproject",
        "PWD" => "Project.123"
    );

    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    $tsql= "SELECT * FROM [dbo].[Student] WHERE FristName LIKE '%$search%'";
    $getResults= sqlsrv_query($conn, $tsql);

    if ($getResults == FALSE) {
        echo (sqlsrv_errors());
    }
    ?>
    <div class="container mt-5">

        <form action="" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control form-control-lg" placeholder="Search Here" name="search">
                <button type="submit" class="input-group-text btn-success"><i class="bi bi-search me-2"></i> Search</button>
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
                            <td scope="col" class="text-center">StudentID</td>
                            <td scope="col" class="text-center">FristName</td>
                            <td scope="col" class="text-center">LastName</td>
                            <td scope="col" class="text-center">District</td>
                            <td scope="col" class="text-center">Province</td>
                            <td scope="col" class="text-center">Region</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
                        ?>
                            <tr>
                            <th scope="row" class="text-end"><?php echo $row['StudentID']; ?></th>
                            <td class="text-center fs-6"><?php echo $row['FristName']; ?></td>
                            <td class="text-center fs-6"><?php echo $row['LastName']; ?></td>
                            <td class="text-center fs-6"><?php echo $row['District']; ?></td>
                            <td class="text-center fs-6"><?php echo $row['Province']; ?></td>
                            <td class="text-center fs-6"><?php echo $row['Region']; ?></td>
                            </tr>
                        <?php
                        }
                        sqlsrv_free_stmt($getResults);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>