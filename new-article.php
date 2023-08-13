<?php

require 'includes/database.php'; //Contains getDB()
require 'includes/article.php'; 
require 'includes/url.php';

$title = '';
$content = '';
$published_at = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {       

    $title = $_POST['title']; //Check if title has been submitted
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    $errors = validateArticle($title, $content, $published_at);

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

                redirect("/article.php?id=$id");

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