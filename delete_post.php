<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['index'])) {
    $deleteIndex = (int)$_POST['index'];
    $posts = file_exists('posts.txt') ? file('posts.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
    
    if (isset($posts[$deleteIndex])) {
        // Delete the post
        unset($posts[$deleteIndex]);
        $result = file_put_contents('posts.txt', implode(PHP_EOL, $posts) . (empty($posts) ? '' : PHP_EOL));
        
        // Delete the associated comments file
        $commentFile = "comments_post_$deleteIndex.txt";
        if (file_exists($commentFile)) {
            unlink($commentFile);
        }
        
        if ($result !== false) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Failed to update posts.txt']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Invalid post index']);
    }
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Missing or invalid index']);
}
?>
