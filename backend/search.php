<?php
$pageTitle = 'Search';
require 'includes/header.php';
$q = clean($_GET['q'] ?? '', 100);
$rows = [];
if ($q !== '') {
    foreach (load_data() as $u) {
        $unitHit = mb_stripos($u['title'], $q) !== false;
        foreach ($u['topics'] as $t) {
            if ($unitHit || mb_stripos($t['topic_title'], $q) !== false || mb_stripos($t['topic_description'], $q) !== false)
                $rows[] = ['uid' => $u['id'], 'n' => $u['unit_number'], 'ut' => $u['title'], 't' => $t];
        }
    }
}
?>
<section class="hero">
  <h1>Search</h1>
  <form class="search-form" action="search.php" method="get">
    <input type="search" name="q" value="<?= e($q) ?>" placeholder="Search syllabus topics..." maxlength="100" required>
    <button class="btn" type="submit">Search</button>
  </form>
</section>
<?php if ($q !== ''): ?>
  <?php if (!$rows): ?><p class="empty">No syllabus topic found.</p><?php endif; ?>
  <div class="topic-list">
  <?php foreach ($rows as $r): ?>
    <a class="topic-card result" href="unit.php?id=<?= (int)$r['uid'] ?>">
      <small>UNIT <?= (int)$r['n'] ?> · <?= e($r['ut']) ?></small>
      <strong><?= e($r['t']['topic_title']) ?></strong>
      <span><?= e($r['t']['topic_description']) ?></span>
    </a>
  <?php endforeach; ?>
  </div>
<?php endif; require 'includes/footer.php'; ?>
