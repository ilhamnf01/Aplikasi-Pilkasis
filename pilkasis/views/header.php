<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Pilkasis</title>
    <link rel="stylesheet" href="/pilkasis/assets/css/style.css">
</head>
<body>
<header>
    <h1>Pilkasis</h1>
    <?php if (isset($_SESSION['user'])): ?>
        <nav>
            <a href="/pilkasis">Dashboard</a> |
            <a href="?route=hasil">Hasil</a> |
            <a href="?route=logout">Logout</a>
        </nav>
    <?php endif; ?>
</header>
<main>
<?php if (!empty($_SESSION['flash'])) { echo '<p class="flash">'.htmlspecialchars($_SESSION['flash']).'</p>'; unset($_SESSION['flash']); } ?>
