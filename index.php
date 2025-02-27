<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new_app</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>*Anonymous Toxicity*</h1>
    <p>This is just another <u>toxic</u> web page.</p>
    <div id="new_app"></div>
    <h2 style="color:#00FF00;">Try It</h2>
    <img src="always.gif" alt="always" style="width:100px;height:100px;">
    <div class="post-form">
        <form id="post-form" method="POST" action="save_post.php">
            <textarea id="post-input" name="post" placeholder="What's up with you?"></textarea>
            <button type="submit" id="post-button">Post</button>
        </form>
    </div>
    <div id="posts">
<?php
        if (file_exists("posts.txt")) {
        //Save the post input in a file named posts.txt
            $posts = file("posts.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        //Reversing the array LIFO and 
            foreach (array_reverse($posts) as $index => $post) {
                echo "<div class='post'>";
                echo "<u class='anonymous-label' style='color: white;'>#Anonymous" . htmlspecialchars($index + 1 ) . " </u>#"; 
                echo "<span>" . htmlspecialchars($post) . "</span>";
                echo "<span class='delete-post' data-index='$index'>x</span>";
                echo "</div>";
                }
            }
        ?>
    </div>
    <script src="script.js"></script>
</body>
</html>
