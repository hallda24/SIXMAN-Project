<?php 

    require_once "dbConnect.php";

    $errors = []; //To store errors
    $editData = []; //Pass back the data to `form.php`

    /* Validate the form on the server side */
    if (empty($_POST['StudentID'])) { 
        $errors['StudentID'] = 'StudentID is required';
    }
    if (empty($_POST['FristName'])) {
        $errors['FristName'] = 'FristName is required';
    }
    if (empty($_POST['LastName'])) {
        $errors['LastName'] = 'LastName is required';
    }
    if (empty($_POST['District'])) {
        $errors['District'] = 'District is required';
    }
    if (empty($_POST['Province'])) {
        $errors['Province'] = 'Province is required';
    }
    if (empty($_POST['Region'])) {
        $errors['Region'] = 'Province is required';
    }

    if (!empty($errors)) { //If errors in validation
        $editData['status'] = false;
        $editData['errors']  = $errors;
    }

    else { //If not, process the form, and return true on success

        $StudentID = $_POST['StudentID'];
        $FristName = $_POST['FristName'];
        $LastName = $_POST['LastName'];
        $District = $_POST['District'];
        $Province = $_POST['Province'];
        $Region = $_POST['Region'];

        $sql = "UPDATE [dbo].[Student] SET FristName='$FristName',LastName='$LastName' WHERE StudentID='$StudentID'";

        $getResults= sqlsrv_query($conn, $sql);

        if ($getResults == FALSE) {
            $form_data['errors'] = sqlsrv_errors();
        }

        $editData['status'] = true;
    }

    //Return the data back to form.php
    echo json_encode($editData);

?>
