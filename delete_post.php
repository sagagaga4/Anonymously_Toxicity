<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["index"])) {
    $index = (int)$_POST["index"];
    $posts = file("posts.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (isset($posts[$index])) {
        unset($posts[$index]);
        file_put_contents("posts.txt", implode("\n", array_values($posts)) . "\n");
    }
}
?>
