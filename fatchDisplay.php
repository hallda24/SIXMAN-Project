<?php 

    require_once "dbConnect.php";

    $errors = []; //To store errors
    $form_data = []; //Pass back the data to `form.php`

    /* Validate the form on the server side */
    if (empty($_POST['search'])) { //Name cannot be empty
        $errors['search'] = 'search is required';
    }

    if (!empty($errors)) { //If errors in validation
        $form_data['success'] = false;
        $form_data['errors']  = $errors;
    }

    else { //If not, process the form, and return true on success

        $search = $_POST['search'];

        /* $arrayString = explode(" ", $search); */
        $arrayString = preg_split('/\s+/', $search);

        if (count($arrayString) == 1) {
            $sql = "SELECT * FROM [dbo].[Student] WHERE FristName LIKE '%$search%'";
        } else if (count($arrayString) == 2) {
            $sql = "SELECT * FROM [dbo].[Student] WHERE FristName LIKE '%$arrayString[0]%' AND LastName LIKE '%$arrayString[1]%'";
        }

        /* $sql= "SELECT * FROM [dbo].[Student] WHERE FristName LIKE '%$arrayString[0]%' OR LastName LIKE '%$arrayString[0]%'"; */
        $getResults= sqlsrv_query($conn, $sql);

        if ($getResults == FALSE) {
            $form_data['errors'] = sqlsrv_errors();
        }

        while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
            $form_data['data'][] = $row;
        }

        $form_data['search']  = $search;
        $form_data['success'] = true;
    }

    //Return the data back to form.php
    echo json_encode($form_data);

?>
