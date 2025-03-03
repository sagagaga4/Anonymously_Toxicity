<?php
// Array of GIF URLs (replace with your GIF links or local paths)
$gifArray = [
    "https://media.giphy.com/media/3o7aCSPqXE5C6T8tBC/giphy.gif", // Example GIF 1
    "https://media.giphy.com/media/3o7TKz2oT5vO9A7kQw/giphy.gif", // Example GIF 2
    "https://media.giphy.com/media/l46Ccr9D5y8i8apvK/giphy.gif", // Example GIF 3
    "https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExeHNkcDczbWpuNXR6aHVieGlkbG52dThoY2Q5MW5jMngwNm5lemJ1eSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/l41YxqKAG3dws45va/giphy.gif",
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

// Function to get a random GIF
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
                $gifUrl = getRandomGif($gifArray); // Assign a random GIF for each post
                echo "<div class='post'>";
                echo "<img class='post-avatar' src='$gifUrl' width='18' height='18' style='border-radius: 50px;' alt='Anonymous Avatar'>";
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
