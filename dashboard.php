<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

include_once 'includes/db.php';
include_once 'classes/Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $post->user_id = $_SESSION['user']['id'];
        $post->title = $_POST['title'];
        $post->content = $_POST['content'];
        $post->img = $_POST['img'];

        if ($post->create()) {
            echo "<div class='alert alert-success'>Post created successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Post creation failed. Please try again.</div>";
        }
    }
}

include_once 'includes/header.php';
?>

<h2>Create Post</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Content</label>
        <textarea name="content" class="form-control" rows="5" required></textarea>
    </div>
    <div class="form-group">
        <label>Image URL</label>
        <input type="text" name="img" class="form-control">
    </div>
    <button type="submit" name="create" class="btn btn-primary">Create Post</button>
</form>

<?php include_once 'includes/footer.php'; ?>
