<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require 'includes/database.php'; //Connects to the database ($conn) 

    //Adds input data from form to specified database
    $sql = "INSERT INTO article (title, content, published_at)
            VALUES('" . mysqli_escape_string($conn, $_POST['title']) . "',
                   '" . mysqli_escape_string($conn, $_POST['content']) . "',
                   '" . mysqli_escape_string($conn, $_POST['published_at']) . "')";    

    $results = mysqli_query($conn, $sql); //Query db

    //Print error
    if($results === false) {
        echo mysqli_error($conn);
    } 
    //Retrieve ID of inserted record
    else {
        $id = mysqli_insert_id($conn);
        echo "Inserted record with ID: $id";
    }
}

require 'includes/header.php' ?>

<h2>New article</h2>

<form method="post">

    <div>
        <label for="title">Title</label>
        <input name="title" id="title" placeholder="Article title">
    </div>

    <div>
        <textarea name="content" id="content" rows="4" cols="40" placeholder="Article Content"></textarea>
    </div>

    <div>
        <label for="published_at">Publication date and time</label>
        <input type="datetime-local" name="published_at" id="published_at">
    </div>

    <button>Add</button>

</form>

<?php require 'includes/footer.php' ?>