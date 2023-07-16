<?php

require 'includes/database.php';
require 'includes/article.php';

$conn = getDB();

if (isset($_GET['id'])){ //Checks if URL param is a number and has been defined

    $article = getArticle($conn, $_GET['id']);

    if( $article)
    {
        $title = $article['title'];
        $content = $article['content'];
        $published_at = $article['published_at'];
    }
    else
    {
        $die("article not found");
    }

}
else 
{ //Null if not a number
    $die("id not supplied, article not found");
}


require 'includes/header.php' ?>

<h2>Edit article</h2>

<?php 
    require 'includes/article-form.php';
    require 'includes/footer.php';
?>