<?php

require 'includes/database.php';

$conn = getDB();

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

<?php require 'includes/header.php'; ?>

<a href="new-article.php">Create new article</a>

        <?php if (empty($articles)): ?>
            <p>No articles found.</p>
        <?php else: ?>

            <ul>                
                <?php foreach ($articles as $article): ?>
                    <li>
                        <article>
                            <!-- Create a link from the articles title. This link uses the articles ID to go to the specific page-->
                            <h2><a href="article.php?id=<?= $article['id']; ?>"><?= htmlspecialchars($article['title']); ?></a></h2>                            
                            <p><?= htmlspecialchars($article['content']); ?></p>
                        </article>
                    </li>
                <?php endforeach; ?>
            </ul>

        <?php endif; ?>

<?php require 'includes/footer.php'; ?>
