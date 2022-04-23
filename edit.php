<?php 

    require_once "dbConnect.php";

    $errors = []; //To store errors
    $form_data = []; //Pass back the data to `form.php`
    $search = $_POST['search'];

    $tsql= "SELECT * FROM [dbo].[Student] WHERE FristName LIKE '%$search%' OR LastName LIKE '%$search%'";
    $getResults= sqlsrv_query($conn, $tsql);

    if ($getResults == FALSE) {
        $form_data['errors'] = sqlsrv_errors();
    }

    /* Validate the form on the server side */
    if (empty($_POST['search'])) { //Name cannot be empty
        $errors['search'] = 'search is required';
    }

    if (!empty($errors)) { //If errors in validation
        $form_data['success'] = false;
        $form_data['errors']  = $errors;
    }

    else { //If not, process the form, and return true on success

        while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
            $form_data['success'] = true;
            $form_data['data'][] = $row;
        }

    }

//Return the data back to form.php
echo json_encode($form_data);

?>
