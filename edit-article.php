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

var_dump($article);