<?php
    $isLoggedIn = false;
    include_once '../../connection/connect.php';
    if(isset($_COOKIE['adminToken'])) {
        $sql = "SELECT username FROM users WHERE username='".$_COOKIE['adminToken']."'";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['username'] == $_COOKIE['adminToken']) {
                    $isLoggedIn = true;
                }
            }
        }
    }
    if(!$isLoggedIn) {
        include '../../actions/redirect.php';
        redirect('../../index.php?ecode=accessdenied');
    }
?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>
<nav>
<div class="dropDown">

</div>
<h1>Home | Admin Section</h1>
<a href="../../index.php">Return to Index</a>
</nav>