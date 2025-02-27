<?php
//If a REQUEST_METHOD has been sent from the form, "If submit was clicked on" 
//Ignore any "/n" and place the date inside the file
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["post"])) {
    $post = trim($_POST["post"]);
    file_put_contents("posts.txt", $post . PHP_EOL, FILE_APPEND);
}
header("Location: index.php");
exit;
?>
