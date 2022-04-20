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
    
  <link rel="stylesheet" href="css\style.css">
  
  <title>Hello</title>
</head>
<body>
  <?php
    $serverName = "myosproject.database.windows.net"; 
    $connectionOptions = array(
        "Database" => "myosproject", 
        "Uid" => "osproject",
        "PWD" => "Project.123"
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    /* $insert_test= "INSERT INTO [dbo].[Persons] (PersonID, FirstName, LastName, Address, City) 
    VALUES ('1', 'น้ำ', 'ฝน', '5', 'เชียงใหม่')";
    $getinsert = sqlsrv_query($conn, $insert_test); */

    $tsql= "SELECT * FROM [dbo].[Student]";
    $getResults= sqlsrv_query($conn, $tsql);

    if ($getResults == FALSE) {
        echo (sqlsrv_errors());
    }
    ?>

    <div class="container mt-5">
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <td scope="col">StudentID</td>
            <td scope="col">FristName</td>
            <td scope="col">LastName</td>
            <td scope="col">District</td>
            <td scope="col">Province</td>
            <td scope="col">Region</td>
          </tr>
        </thead>
      <tbody>
      <?php
      while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
      ?>
        <tr>
          <th scope="row" class="text-end"><?php echo $row['StudentID']; ?></th>
          <td class="text-center fs-5"><?php echo $row['FristName']; ?></td>
          <td class="text-center fs-5"><?php echo $row['LastName']; ?></td>
          <td class="text-center fs-5"><?php echo $row['District']; ?></td>
          <td class="text-center fs-5"><?php echo $row['Province']; ?></td>
          <td class="text-center fs-5"><?php echo $row['Region']; ?></td>
        </tr>
    <?php
    }
    sqlsrv_free_stmt($getResults);
    ?>
      </tbody>
    </table>
    </div>
</body>
</html>