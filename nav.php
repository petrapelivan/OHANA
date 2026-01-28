<?php
session_start();
?>

<nav class="main-nav">

    <div class="nav-container">

        <div class="nav-logo">
            <a href="index.php">
                <img src="img/logo.jpeg" alt="OHANA logo">
            </a>
        </div>

        <ul class="nav-menu">
            <li><a href="index.php">Početna</a></li>
            <li><a href="about-us.php">O nama</a></li>
            <li><a href="news.php">Novosti</a></li>
            <li><a href="contact.php">Kontakt</a></li>

            <?php if (isset($_SESSION['admin'])): ?>
                <li><a href="admin/reports.php" class="admin-link">Izvještaji</a></li>
                <li><a href="admin/logout.php" class="admin-link">Logout</a></li>
            <?php else: ?>
                <li><a href="admin/login.php" class="admin-link">Login</a></li>
            <?php endif; ?>
        </ul>

    </div>
</nav>


