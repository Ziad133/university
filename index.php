<?php
session_start();
include_once 'includes/db.php';
include_once 'classes/Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);
$stmt = $post->read();

include_once 'includes/header.php';
?>

<h2>Recent Posts</h2>

<?php
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    echo "<div class='card mb-3'>";
    if (!empty($img)) {
        echo "<img src='$img' class='card-img-top' alt='Post Image'>";
    }
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>$title</h5>";
    echo "<p class='card-text'>$content</p>";
    echo "</div>";
    echo "</div>";
}
?>

<?php include_once 'includes/footer.php'; ?>
