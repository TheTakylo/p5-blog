<?php foreach (Flash::all() as $type => $messages): ?>
    <?php foreach ($messages as $message): ?>
        <div class="alert alert-<?= $type ?>"><?= $message ?></div>
    <?php endforeach; ?>
<?php endforeach; ?>