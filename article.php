<?php

require 'database.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])){ //Checks if URL param is a number and has been defined

    //Get data from the article table
    $sql = "SELECT *
            FROM article        
            WHERE id = " . $_GET['id']; //Gets the key from url param specified by index.php to access the associated value

    $results = mysqli_query($conn, $sql); //Query db

    //Print error
    if($results === false) {
        echo mysqli_error($conn);
    } 
    //Fetch and display row (Associative to display names for columns)
    else {
        $article = mysqli_fetch_assoc($results);
    }

}
else { //Null if not a number
    $article = null;
}

?>

<?php require 'header.php'; ?>

        <?php if ($article === NULL): ?>
            <p>Article not found.</p>
        <?php else: ?>    

            <article>
                <h2><?= $article['title']; ?></h2>
                <p><?= $article['content']; ?></p>
            </article>        

        <?php endif; ?>
        
<?php require 'footer.php'; ?>
