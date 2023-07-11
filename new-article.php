<?php

require 'includes/database.php'; //Contains getDB()

if ($_SERVER["REQUEST_METHOD"] == "POST") {   

    $conn = getDB();

    //Adds input data from form to specified database
    $sql = "INSERT INTO article (title, content, published_at)
            VALUES(?, ?, ?)"; //Values for our prepared statement

    $stmt = mysqli_prepare($conn, $sql); //Prepare the query

    //Print error
    if($stmt === false) {
        echo mysqli_error($conn);
    }     
    else {

        mysqli_stmt_bind_param($stmt, "sss", $_POST['title'], $_POST['content'], $_POST['published_at']); //Add form data (expecting three strings "sss") to prepared statement
        
        //On successful execution the auto-generated ID is inserted into the record
        if(mysqli_stmt_execute($stmt)) {  

        $id = mysqli_insert_id($conn);        
        echo "Inserted record with ID: $id";

        } else {

            echo mysqli_stmt_errno($stmt);
        }
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