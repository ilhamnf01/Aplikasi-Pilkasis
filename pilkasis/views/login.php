<?php include __DIR__ . '/header.php'; ?>
<h2>Login</h2>
<form method="post" action="?route=login">
    <label>Username<br><input type="text" name="username" required></label><br>
    <label>Password<br><input type="password" name="password" required></label><br>
    <button type="submit">Login</button>
</form>

<p>Seeded accounts: admin/admin123, siswa1/siswa123</p>

<?php include __DIR__ . '/footer.php'; ?>
