<?php

$error =$_SERVER["REDIRECT_STATUS"];

$error_title = '';
$error_message = '';

if($error == 404)
{
    $error_title = "404 PAge Not Found";
    $error_message = "The document/file requested was not found on this server.";
}

?>

<html>
<body>
    <h1><?php echo $error_title; ?></h1>
    <h5><?php echo $error_message; ?></h5>
</body>
</html>