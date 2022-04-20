<?php

    $search = $_POST['search'];

    $serverName = "myosproject.database.windows.net"; // update me
    $connectionOptions = array(
            "Database" => "mySampleDatabase", // update me
            "Uid" => "osproject", // update me
            "PWD" => "Project.123" // update me
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    $sql = "select * from students where name like '%$search%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0){
    while($row = $result->fetch_assoc() ){
        echo $row["name"]."  ".$row["age"]."  ".$row["gender"]."<br>";
    }
    } else {
        echo "0 records";
    }

    $conn->close();

    ?>