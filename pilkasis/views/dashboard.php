<?php include __DIR__ . '/header.php'; ?>
<h2>Dashboard</h2>
<p>Halo, <?php echo htmlspecialchars($_SESSION['user']['username']); ?> (<?php echo htmlspecialchars($_SESSION['user']['role']); ?>)</p>

<?php
require_once __DIR__ . '/../models/Kandidat.php';
$km = new Kandidat();
$cands = $km->getAll();
?>

<section>
    <h3>Daftar Kandidat</h3>
    <ul>
        <?php foreach ($cands as $c): ?>
            <li>
                <strong><?php echo htmlspecialchars($c['nama']); ?></strong>
                <p><?php echo htmlspecialchars($c['visi']); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<?php if ($_SESSION['user']['role'] === 'siswa'): ?>
    <?php include __DIR__ . '/voting.php'; ?>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>
