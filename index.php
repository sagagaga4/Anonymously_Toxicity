<?php
$gifArray = [
    "https://media.giphy.com/media/3o7aCSPqXE5C6T8tBC/giphy.gif",
    "https://media.giphy.com/media/3o7TKz2oT5vO9A7kQw/giphy.gif",
    "https://media.giphy.com/media/l46Ccr9D5y8i8apvK/giphy.gif",
    "https://media4.giphy.com/media/l41YxqKAG3dws45va/giphy.gif",
    "https://media1.giphy.com/media/AImT2CvPZvkTC/200.webp?cid=ecf05e470t90j0l04kgus4aihbt88xm8jisg2bua688sr3il&ep=v1_gifs_related&rid=200.webp&ct=g",
    "https://media0.giphy.com/media/Y2CgrQyxLSiS4/200.webp?cid=ecf05e47unbyajx6n1wnjoou4g5cypki3tzc19z9eiyzu6ni&ep=v1_gifs_related&rid=200.webp&ct=g",
    "https://media1.giphy.com/media/xTiTnyh1Dt2F7IiHIs/giphy.webp?cid=ecf05e47vhyl9p39unxmzb4h030qyzqm0h4s2gkg73y4nni1&ep=v1_gifs_related&rid=giphy.webp&ct=g",
    "https://media1.giphy.com/media/cAppo8bFFo61W/giphy.webp?cid=ecf05e476wqq5vg5yjpr6co8ogrguhof3hfk5mpg21zctv4w&ep=v1_gifs_related&rid=giphy.webp&ct=g",
    "https://media3.giphy.com/media/zsp6JrZQf3rPy/giphy.webp?cid=ecf05e474o08l7xwcuj7g80rc74iw3ktop7rfnnh2gwzgpvi&ep=v1_gifs_related&rid=giphy.webp&ct=g",
    "https://media1.giphy.com/media/l3q2LhvyXCvgC9Xdm/200.webp?cid=ecf05e474o08l7xwcuj7g80rc74iw3ktop7rfnnh2gwzgpvi&ep=v1_gifs_related&rid=200.webp&ct=g",
    "https://media2.giphy.com/media/lB0vWF9au9XRC/200.webp?cid=ecf05e47vrrbo6o772momp9wvaw88ag9l56pmsymzztfpp9k&ep=v1_gifs_related&rid=200.webp&ct=g",
    "https://media1.giphy.com/media/i3kswTJpWYN7G/200.webp?cid=790b7611839v678bsxfct3mc31c2w3ewb16yyhio8a7di168&ep=v1_gifs_search&rid=200.webp&ct=g",
    "https://media4.giphy.com/media/sIIhZliB2McAo/giphy.webp?cid=790b76112fpiuezg1ze80ko2jc08fxzamstj4l3w1c0v7uvl&ep=v1_gifs_search&rid=giphy.webp&ct=g",
    "https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExaTBiaTJxbncwdnpvenQzcHZmaDZ6eXN4eTRpZmtsbTR6bzlmcHZtNiZlcD12MV9naWZzX3NlYXJjaCZjdD1n/CnTzlGz79qPUXBpyPL/giphy.webp",
];

$comments = file_exists('comments.txt') ? file('comments.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['comment']) && isset($_POST['post_index'])) {
    $index = (int)$_POST['post_index'];
    $commentFile = "comments_post_$index.txt";
    file_put_contents($commentFile, htmlspecialchars($_POST['comment']) . PHP_EOL, FILE_APPEND);
    header('Location: /');
    exit;
}

function getRandomGif($gifArray) {
    return $gifArray[array_rand($gifArray)];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new_app</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .comment-section { display: none; margin-top: 10px; background-color: black; color: white; }
        .comment-list { list-style: none; padding: 0; background-color: black; }
    </style>
</head>
<body>
    <div id="new_app"></div>
    <div class="post-form">
        <form id="post-form" method="POST" action="save_post.php" enctype="multipart/form-data">
            <textarea id="post-input" name="post" placeholder="What's up with you?"></textarea>
            <div class="button-container">
                <div class="image-upload-container">
                    <label for="image-upload" class="image-upload-label">
                        <span class="upload-icon">📷</span>
                        <span class="upload-text">Add image</span>
                    </label>
                    <input type="file" id="image-upload" name="image" accept="image/*" style="display: none;">
                    <span id="selected-file-name"></span>
                </div>
                <button type="submit" id="post-button">Post</button>
            </div>
        </form>
    </div>
    <div id="posts">
<?php
    if (file_exists("posts.txt")) {
        $posts = file("posts.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach (array_reverse($posts) as $index => $post) {
            $gifUrl = getRandomGif($gifArray);
            $commentFile = "comments_post_$index.txt";
            $comments = file_exists($commentFile) ? file($commentFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
            
            // Decode JSON post data
            $postData = json_decode($post, true);
            $postText = isset($postData['text']) ? $postData['text'] : '';
            $postImage = isset($postData['image']) ? $postData['image'] : '';

            echo "<div class='post'>";
            echo "<img class='post-avatar' src='$gifUrl' width='18' height='18' style='border-radius: 50px;' alt='Anonymous Avatar'>";
            echo "<u class='anonymous-label' style='color:#9debeb;'>#Anonymous" . htmlspecialchars($index + 1) . " </u> ";
            echo "<span>" . htmlspecialchars($postText) . "</span>";

            // Display the image if it exists
            if (!empty($postImage) && file_exists('uploads/' . $postImage)) {
                echo "<div class='post-image-container'>";
                echo "<img src='uploads/" . htmlspecialchars($postImage) . "' class='post-image' alt='User uploaded image'>";
                echo "</div>";
            }

            echo "<div class='post-actions'>";
            echo "<span class='comment' data-index='$index'>Comment</span>";
            echo "<span class='repost' data-index='$index'>Repost</span>";
            echo "<span class='like-btn' data-index='$index'>♡</span>";
            echo "<span class='like-count' data-index='$index'>0</span>";
            echo "</div>";
            echo "<div class='comment-section' id='comments-$index'>";
            echo "<ul class='comment-list'>";
            foreach ($comments as $comment) {
                echo "<li>" . htmlspecialchars($comment) . "</li>";
            }
            echo "</ul>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='post_index' value='$index'>";
            echo "<input type='text' name='comment' placeholder='Add a comment' required>";
            echo "<button type='submit'>Post</button>";
            echo "</form>";
            echo "</div>";
            echo "<span class='delete-post' data-index='$index'>x</span>";
            echo "</div>";
        }
    }
?>
    </div>
    <script>
        document.querySelectorAll('.comment').forEach(btn => {
            btn.addEventListener('click', () => {
                const index = btn.getAttribute('data-index');
                const section = document.getElementById(`comments-${index}`);
                section.style.display = section.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>
    <script src="script.js"></script>
</body>
</html>
