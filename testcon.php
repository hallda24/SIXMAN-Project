<?php
    $serverName = "osdatabaseproject.database.windows.net"; // update me
    $connectionOptions = array(
        "Database" => "Student", // update me
        "Uid" => "osdatabaseproject", // update me
        "PWD" => "~75\$XrCbSG{NXM6s" // update me
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    $tsql= "SELECT TOP (1000) * FROM [dbo].[Student]";
    $getResults= sqlsrv_query($conn, $tsql);
    echo ("Reading data from table" . PHP_EOL);
    if ($getResults == FALSE)
        echo (sqlsrv_errors());
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
     echo ($row['FristName'] . " " . $row['LastName'] . PHP_EOL);
    }
    sqlsrv_free_stmt($getResults);
?>