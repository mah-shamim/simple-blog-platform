<?php
include '../include/db.php';

header('Content-Type: application/json');

// Retrieve POST data
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$title = $_POST['title'];
$content = $_POST['content'];

try {
    if ($id > 0) {
        // Update existing post
        $stmt = $pdo->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $stmt->execute([$title, $content, $id]);
    } else {
        // Insert new post
        $stmt = $pdo->prepare('INSERT INTO posts (title, content) VALUES (?, ?)');
        $stmt->execute([$title, $content]);
    }
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
