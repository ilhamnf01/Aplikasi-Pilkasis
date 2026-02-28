<?php
// voting form included in dashboard for siswa
require_once __DIR__ . '/../models/Voting.php';
$vm = new Voting();
if ($vm->hasUserVoted($_SESSION['user']['id'])):
?>
    <p>Anda sudah memilih. Terima kasih.</p>
<?php else: ?>
    <form method="post" action="?route=vote">
        <h3>Voting</h3>
        <?php foreach ($cands as $c): ?>
            <label>
                <input type="radio" name="kandidat" value="<?php echo $c['id_kandidat']; ?>"> <?php echo htmlspecialchars($c['nama']); ?>
            </label><br>
        <?php endforeach; ?>
        <button type="submit">Kirim Suara</button>
    </form>
<?php endif; ?>
