<?php
$base = '../'; $pageTitle = 'Add Topic';
require_once '../config/data.php';
$uid = (int)($_GET['unit_id'] ?? $_POST['unit_id'] ?? 0);
$data = load_data();
$i = unit_index($data, $uid);
if ($i < 0) go('index.php?msg=' . urlencode('Unit not found.'));
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $t = clean($_POST['topic_title'] ?? '', 200); $d = clean($_POST['topic_description'] ?? '', 3000);
    if ($t === '') $err = 'Topic title is required.';
    else {
        $n = 1; foreach ($data[$i]['topics'] as $x) $n = max($n, $x['topic_number'] + 1);
        $data[$i]['topics'][] = ['id' => next_topic_id($data), 'topic_number' => $n, 'topic_title' => $t, 'topic_description' => $d];
        save_data($data);
        go('index.php?msg=' . urlencode('Topic added.'));
    }
}
require '../includes/header.php';
?>
<h1>Add Topic to Unit <?= (int)$data[$i]['unit_number'] ?></h1>
<?php if ($err): ?><div class="alert error"><?= e($err) ?></div><?php endif; ?>
<form class="form validate" method="post">
  <input type="hidden" name="unit_id" value="<?= $uid ?>">
  <label>Topic title<input type="text" name="topic_title" maxlength="200" required></label>
  <label>Topic description<textarea name="topic_description" rows="5"></textarea></label>
  <button class="btn" type="submit">Save Topic</button> <a class="btn btn-alt" href="index.php">Cancel</a>
</form>
<?php require '../includes/footer.php'; ?>
