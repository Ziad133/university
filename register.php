<?php
session_start();
include_once 'includes/db.php';
include_once 'classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->phone = $_POST['phone'];
    $user->password = $_POST['password'];
    $user->role = 'subscriber';

    if ($user->register()) {
        echo "<div class='alert alert-success'>Registration successful. <a href='login.php'>Login here</a>.</div>";
    } else {
        echo "<div class='alert alert-danger'>Registration failed. Please try again.</div>";
    }
}

include_once 'includes/header.php';
?>

<h2>Register</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>

<?php include_once 'includes/footer.php'; ?>
