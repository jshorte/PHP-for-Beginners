<?php

require 'includes/database.php';
require 'includes/article.php';

$conn = getDB();

if (isset($_GET['id'])) { //Checks if URL param is a number and has been defined

    $article = getArticle($conn, $_GET['id']);

    //If table record id exists then assign all row contents into variables
    if($article) {

        $id = $article['id'];
        $title = $article['title'];
        $content = $article['content'];
        $published_at = $article['published_at'];
    }
    else {
        $die("article not found");
    }

}
else 
{ //Null if not a number
    $die("id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {       

    //Check if content has been submitted for each field 
    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    $errors = validateArticle($title, $content, $published_at);

    //If there are no errors proceed with updating table
    if(empty($errors)) {       

        //Adds input data from form to specified database
        $sql = "UPDATE article 
                SET title = ?,
                    content = ?,
                    published_at = ?
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql); //Prepare the query

        //Print error if query failed
        if($stmt === false) {
            echo mysqli_error($conn);
        } 
        //No errors and query passed    
        else {

            //Allow published_at to be empty if specified
            if ($published_at == '') {
                $published_at = null;
            }

            mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $published_at, $id); //Add form data (three strings "sss" and int "i") to prepared statement
            
            //On successful execution the auto-generated ID is inserted into the record
            if(mysqli_stmt_execute($stmt)) {               

                //Change protocoll depending on HTTPS settings
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

<h2>Edit article</h2>

<?php 
    require 'includes/article-form.php';
    require 'includes/footer.php';
?>