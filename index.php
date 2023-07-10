<?php

$name = "Jacob " . "Shorte";
$hour = 12;

?>

<!DOCTYPE html>
<html>
<head>    
    <title>My Website</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Header 1</h1>

    <p>Hello, <?= $name; ?></p>    

    <?php if ($hour < 12) : ?> 
        Good morning <?php echo "(Hour: {$hour} )"; ?>  
    <?php elseif($hour < 18) : ?>    
        Good afternoon <?php echo "(Hour: {$hour} )"; ?>        
    <?php elseif($hour < 22) : ?>
        Good evening <?php echo "(Hour: {$hour} )"; ?>     
    <?php else : ?>
        Good night <?php echo "(Hour: {$hour} )"; ?>    
    <?php endif; ?>  

</body>    