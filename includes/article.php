<?php

/**
 * Get the article record based on the ID
 * 
 * @param object $conn Connetion to the database
 * @param integer $id the article ID
 * 
 * @return mixed An associative array containtain the article with that ID, or null if not found
 */

function getArticle($conn, $id)
{
    $sql = "SELECT *
    FROM article        
    WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if($stmt === false)
    {
        echo mysqli_error($conn);
    }
    else
    {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt))
        {
            $result = mysqli_stmt_get_result($stmt);

            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}

/**
 * Validate the article properties
 * 
 * @param string $title Title, required
 * @param string $content Content, required
 * @param string $published_at Published date and time, yyy-mm-dd hh:mm:ss if not blank
 * 
 * @return array An array of validation error messages
 */
function validateArticle($title, $content, $published_at)
{
    $errors = []; //Instantiate

    //Display error if values not supplied
    if($title == '') 
    {
        $errors[] = 'Title is required';
    }

    if($content == '') 
    {
        $errors[] = 'Content is required';
    }   

    if($published_at !='') 
    {
        $date_time = date_create_from_format('Y-M-D H:I:S', $published_at); //Check input against date time format

        //If the format doesn't match raise an error
        if ($date_time === false) {
            $errors[] = 'Invalid date and time';            
        }        
        else 
        {
            $date_errors = date_get_last_errors();

            //If the format matches but a warning is raised with the entry (EG: 31sth of Februrary - Invalid date but in the correct format) then raise an error
            if ($date_errors['warning_count'] > 0)
            {
                $errors[] = 'Invalid date and time'; 
            }
        }
    }     

    return $errors;
}
