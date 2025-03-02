<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new_app</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="new_app"></div>
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

                $image='<img src="./always.gif" width="18" height="18" style=border-radius:50px;>';
                echo $image;
                echo "<u class='anonymous-label' style='color:#9debeb;' >#Anonymous" . htmlspecialchars($index + 1 ) . " </u> "; 
                echo "<span>" . htmlspecialchars($post) . "</span>";
                echo "<div class='post-actions'>";
                echo "<span class='comment' data-index='$index'>Comment</span>";
                echo "<span class='repost' data-index='$index'>Repost</span>";
                echo "<span class='like-btn' data-index='$index'>♡</span>";
                echo "<span class='like-count' data-index='$index'>0</span>";
                echo "</div>";
                
                echo "<span class='delete-post' data-index='$index'>x</span>";
                echo "</div>";
            }
        }
?>
    </div>
    <script src="script.js"></script>
</body>
</html>
