<?php 

    $serverName = "osdatabaseproject.database.windows.net"; // update me
    $connectionOptions = array(
        "Database" => "student", // update me
        "Uid" => "osdatabaseproject", // update me
        "PWD" => "~75\$XrCbSG{NXM6s" // update me
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);

?>