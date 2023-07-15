<?php

/**
 * Get the database connection
 * 
 * @return object Connection to a MySQL server
 */
function getDB()
{
    # $db_host = 'localhost';           //Name of the database host
    $db_host = $_SERVER['HTTP_HOST'];   //Name of the database host
    $db_name = 'cms';                   //Name of database
    $db_user = 'cms_www';               //Name of user on the database
    $db_pass = 'KOS4@tALN5*)5yIw';      //Password of the named user on the database

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name); //Connect to server

    //Check if there is an error, if so, print the error and terminate;
    if(mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }

    return $conn;
}