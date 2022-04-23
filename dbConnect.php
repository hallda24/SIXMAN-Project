<?php 

$serverName = "myosproject.database.windows.net"; 
    $connectionOptions = array(
        "Database" => "myosproject", 
        "Uid" => "osproject",
        "PWD" => "Project.123"
    );

    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);

?>