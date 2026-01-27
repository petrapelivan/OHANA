<?php
include("../config.php");

if (isset($_SESSION['admin_id'])) {
    header("Location: ../index.php");
    exit;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {
            $_SESSION['admin'] = $user['username'];
            header("Location:/PHPProjekt/index.php");
            exit();
        } else {
            $error = "Pogrešna lozinka.";
        }
    } else {
        $error = "Korisnik ne postoji.";
    }

if (isset($_SESSION['admin_id'])): ?>
    <li><a href="admin/reports.php">Izvještaji</a></li>
    <li><a href="admin/logout.php">Odjava</a></li>
<?php else: ?>
    <li><a href="admin/login.php">Login</a></li>
<?php endif; 
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin prijava</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<section class="login-section">
    <div class="login-container">
        <h2>Prijava</h2>

        <?php if (!empty($error)): ?>
            <div class="login-error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="username">Korisničko ime</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Lozinka</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Prijavi se</button>
        </form>
    </div>
</section>

</body>
</html>

