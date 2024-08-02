<?php
include '../include/db.php';

header('Content-Type: application/json');

try {

    $stmt = $pdo->query('SELECT * FROM posts ORDER BY created_at DESC');

    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['posts' => $posts]);

} catch (PDOException $e) {

    echo json_encode(['error' => $e->getMessage()]);

}
?>
