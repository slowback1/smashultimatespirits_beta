<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./style/index.css" />
    <link rel="stylesheet" href="./external_scripts/nouislider.min.css" />
    <title><?php echo $name; ?> | Details</title>
</head>
<?php
    //initialize id
    echo "<script>let currentID=$id;</script>";
?>
<body>
    <nav>
        <div onClick="getSpirit('previous', currentID)" class="navArrow" id="previousSpirit">&larr; Previous Spirit</div>
        <a id="indexLink" href="../index.php?place=<?php echo $id; ?>" class="navLink"> Return to Index </a>
        <div onClick="getSpirit('random', 0)" class="navLink"> Random Spirit </a></div>
        <div onClick="getSpirit('next', currentID)" class="navArrow" id="nextSpirit">Next Spirit &rarr;</div>
    </nav>
    