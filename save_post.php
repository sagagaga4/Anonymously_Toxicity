<?php
header('Content-Type: application/json');

// Create uploads directory if it doesn't exist
$uploadsDir = 'uploads/';
if (!file_exists($uploadsDir)) {
    mkdir($uploadsDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post'])) {
    $post = trim($_POST['post']);
    $imageFileName = '';
    
    // Handle image upload if present
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tempName = $_FILES['image']['tmp_name'];
        $originalName = $_FILES['image']['name'];
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $imageFileName = uniqid() . '.' . $extension;
        $uploadPath = $uploadsDir . $imageFileName;
        
        // Move the original image without resizing
        move_uploaded_file($tempName, $uploadPath);
    }
    
    if (!empty($post) || !empty($imageFileName)) {
        // Store the post text and image filename (if any)
        $postData = json_encode([
            'text' => $post,
            'image' => $imageFileName
        ]);
        
        $result = file_put_contents('posts.txt', $postData . PHP_EOL, FILE_APPEND);
        
        if ($result !== false) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Failed to write to posts.txt']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Empty post content']);
    }
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Missing post data']);
}
?>
