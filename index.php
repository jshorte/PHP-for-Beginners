<?php

$db_host = 'localhost';         //Name of the database host
$db_name = 'cms';               //Name of database
$db_user = 'cms_www';           //Name of user on the database
$db_pass = 'KOS4@tALN5*)5yIw';  //Password of the named user on the database

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name); //Connect to server

//Check if there is an error, if so, print the error and terminate;
if(mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
}

# echo "Connection Established";

//Get data from the article table
$sql = "SELECT *
        FROM article        
        ORDER BY id DESC;";

$results = mysqli_query($conn, $sql); //Query db

//Print error
if($results === false) {
    echo mysqli_error($conn);
} 
//Fetch and display results (Associative to display names for columns)
else {
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);

    # var_dump($articles);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>My blog</title>
    <meta charset="utf-8">
</head>
<body>

    <header>
        <h1>My blog</h1>
    </header>

    <main>
        <?php if (empty($articles)): ?>
            <p>No articles found.</p>
        <?php else: ?>

            <ul>                
                <?php foreach ($articles as $article): ?>
                    <li>
                        <article>
                            <!-- Create a link from the articles title. This link uses the articles ID to go to the specific page-->
                            <h2><a href="article.php?id=<?= $article['id']; ?>"><?= $article['title']; ?></a></h2>                            
                            <p><?= $article['content']; ?></p>
                        </article>
                    </li>
                <?php endforeach; ?>
            </ul>

        <?php endif; ?>
    </main>
</body>
</html>
