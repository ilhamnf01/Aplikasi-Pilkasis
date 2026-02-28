<?php include __DIR__ . '/header.php'; ?>
<h2>Hasil Voting</h2>
<?php
require_once __DIR__ . '/../models/Voting.php';
$vm = new Voting();
$results = $results ?? $vm->getResults();
?>
<table>
    <thead><tr><th>Kandidat</th><th>Suara</th></tr></thead>
    <tbody>
    <?php foreach ($results as $r): ?>
        <tr>
            <td><?php echo htmlspecialchars($r['nama']); ?></td>
            <td><?php echo (int)$r['votes']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/footer.php'; ?>
