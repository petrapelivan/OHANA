<?php
session_start();
?>
<link rel="stylesheet" href="../admin/admin-css.css">
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
                <li><a href="admin/logout.php" class="admin-link">Odjava</a></li>
            <?php else: ?>
                <li><a href="admin/login.php" class="admin-link">Prijava</a></li>
            <?php endif; ?>
        </ul>

    </div>
</nav>


