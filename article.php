<?php

require 'includes/database.php';
require 'includes/article.php';

$conn = getDB();

if (isset($_GET['id'])){ //Checks if URL param is a number and has been defined

    $article = getArticle($conn, $_GET['id']);

}
else { //Null if not a number
    $article = null;
}

?>

<?php require 'includes/header.php'; ?>

        <?php if ($article === NULL): ?>
            <p>Article not found.</p>
        <?php else: ?>    

            <article>
                <h2><?= htmlspecialchars($article['title']); ?></h2>
                <p><?= htmlspecialchars($article['content']); ?></p>
            </article>        

        <?php endif; ?>
        
        <a href="edit-article.php?id=<?= $article['id']; ?>">Edit</a> <!-- Link to edit-article page -->

<?php require 'includes/footer.php'; ?>
