<?php

$articles = [ 
    'a' => "First", 
    'b' => "Second",
    'c' => "Third"
];

foreach ($articles as $index => $article)
{
    echo $index . ' - ' . $article, ", ";
}
