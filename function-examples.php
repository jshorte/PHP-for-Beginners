<?php


/**
 * Display Message
 * 
 * @param string with default "Jacob"
 * 
 * @return message
 */
function showMessage($name = 'Jacob') {
    return "Hello {$name}";
}

$msg = showMessage();

echo $msg;