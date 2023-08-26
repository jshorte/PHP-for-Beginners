<?php
require 'includes/database.php';
require 'includes/article.php';
require 'includes/url.php';

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
else {
    $die("ID not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    //Adds input data from form to specified database
    $sql = "DELETE FROM article             
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql); //Prepare the query

    //Print error if query failed
    if($stmt === false) {
        echo mysqli_error($conn);
    } 
    //No errors and query passed    
    else {      

        mysqli_stmt_bind_param($stmt, "i", $id); //Add form data (three strings "sss" and int "i") to prepared statement
        
        //On successful execution the auto-generated ID is inserted into the record
        if(mysqli_stmt_execute($stmt)) {               

        redirect("/index.php");    

        } else {
            echo mysqli_stmt_errno($stmt);
        }
    }
}
require 'includes/header.php'; ?>

<h2> Delete Article</h2>

<form method="post">
    <p>Are you sure?</p>    
    <button>Delete</button>
    <a href="article.php?id=<?= $article['id']; ?>">Cancel</a>
</form>

<?php require 'includes/footer.php'; ?>

