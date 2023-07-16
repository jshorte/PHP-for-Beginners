<?php

require 'includes/database.php'; //Contains getDB()

$errors = [];
$title = '';
$content = '';
$published_at = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {       

    $title = $_POST['title']; //Check if title has been submitted
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    //Display error if values not supplied
    if($title == '') 
    {
        $errors[] = 'Title is required';
    }

    if($content == '') 
    {
        $errors[] = 'Content is required';
    }   

    if($published_at !='') 
    {
        $date_time = date_create_from_format('Y-M-D H:I:S', $published_at); //Check input against date time format

        //If the format doesn't match raise an error
        if ($date_time === false) {
            $errors[] = 'Invalid date and time';            
        }        
        else 
        {
            $date_errors = date_get_last_errors();

            //If the format matches but a warning is raised with the entry (EG: 31sth of Februrary - Invalid date but in the correct format) then raise an error
            if ($date_errors['warning_count'] > 0)
            {
                $errors[] = 'Invalid date and time'; 
            }
        }
    }     

    //If there are no errors proceed with table insertion
    if(empty($errors)) {

        $conn = getDB();

        //Adds input data from form to specified database
        $sql = "INSERT INTO article (title, content, published_at)
                VALUES(?, ?, ?)"; //Values for our prepared statement

        $stmt = mysqli_prepare($conn, $sql); //Prepare the query

        //Print error if query failed
        if($stmt === false) {
            echo mysqli_error($conn);
        } 
        //No errors and query passed    
        else {

            if ($published_at == '') {
                $published_at = null;
            }

            mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at); //Add form data (expecting three strings "sss") to prepared statement
            
            //On successful execution the auto-generated ID is inserted into the record
            if(mysqli_stmt_execute($stmt)) {  

            $id = mysqli_insert_id($conn);   

            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
                $protocol = 'https';
            } else {
                $protocol = 'http';
            }

            header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/article.php?id=$id");
            exit;

            } else {

                echo mysqli_stmt_errno($stmt);
            }
        }
    }
}

require 'includes/header.php' ?>

<h2>New article</h2>

<?php 
    require 'includes/article-form.php';
    require 'includes/footer.php';
?>