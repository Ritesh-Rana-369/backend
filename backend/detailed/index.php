<?php
$pageTitle = 'Home';
require 'includes/header.php';
$units = load_data();
?>
<section class="hero">
  <h1>BACKEND SYLLABUS</h1>
  <p>Complete Unit-wise Backend Subject Syllabus</p>
  <form class="search-form" action="search.php" method="get">
    <input type="search" name="q" placeholder="Search syllabus topics..." maxlength="100" required>
    <button class="btn" type="submit">Search</button>
  </form>
</section>
<section id="units" class="unit-grid">
<?php foreach ($units as $u): ?>
  <a class="capsule fade-in" href="unit.php?id=<?= (int)$u['id'] ?>">
    <span class="capsule-num">UNIT <?= (int)$u['unit_number'] ?></span>
    <h2><?= e($u['title']) ?></h2>
    <p><?= e($u['description']) ?></p>
    <span class="badge"><?= count($u['topics']) ?> Topics</span>
    <span class="btn btn-sm">View Syllabus →</span>
  </a>
<?php endforeach; if (!$units): ?>
  <p class="empty">No units yet. Add some from the admin panel.</p>
<?php endif; ?>
</section>
<?php require 'includes/footer.php'; ?>
