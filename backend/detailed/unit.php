<?php
require_once 'config/data.php';
$data = load_data();
$i = unit_index($data, $_GET['id'] ?? 0);
$unit = $i >= 0 ? $data[$i] : null;
if (!$unit) http_response_code(404);
$pageTitle = $unit ? 'Unit ' . $unit['unit_number'] : 'Not found';
require 'includes/header.php';
if (!$unit) { echo '<p class="empty">Unit not found. <a href="index.php">Back home</a></p>'; require 'includes/footer.php'; exit; }
$topics = $unit['topics'];
?>
<a class="back" href="index.php">← All Units</a>
<section class="unit-head">
  <span class="capsule-num">UNIT <?= (int)$unit['unit_number'] ?></span>
  <h1><?= e($unit['title']) ?></h1>
  <p><?= nl2br(e($unit['description'])) ?></p>
</section>
<h2>Topics (<?= count($topics) ?>)</h2>
<div class="topic-list">
<?php foreach ($topics as $t): ?>
  <div class="topic-card">
    <button class="topic-toggle" type="button" aria-expanded="false">
      <span class="topic-no"><?= (int)$t['topic_number'] ?></span>
      <span class="topic-title"><?= e($t['topic_title']) ?></span>
      <span class="chev">▾</span>
    </button>
    <div class="topic-body"><?= nl2br(e($t['topic_description'])) ?: 'No description.' ?></div>
  </div>
<?php endforeach; if (!$topics): ?><p class="empty">No topics added yet.</p><?php endif; ?>
</div>
<?php require 'includes/footer.php'; ?>
