<?php
$base = '../'; $pageTitle = 'Edit Topic';
require_once '../config/data.php';
$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$data = load_data();
list($ui, $ti) = topic_index($data, $id);
if ($ui < 0) go('index.php?msg=' . urlencode('Topic not found.'));
$t = $data[$ui]['topics'][$ti];
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n = max(1, (int)($_POST['topic_number'] ?? 1)); $title = clean($_POST['topic_title'] ?? '', 200); $d = clean($_POST['topic_description'] ?? '', 3000);
    if ($title === '') { $err = 'Topic title is required.'; $t = array_merge($t, ['topic_number' => $n, 'topic_title' => $title, 'topic_description' => $d]); }
    else {
        $data[$ui]['topics'][$ti] = ['id' => $id, 'topic_number' => $n, 'topic_title' => $title, 'topic_description' => $d];
        save_data($data);
        go('index.php?msg=' . urlencode('Topic updated.'));
    }
}
require '../includes/header.php';
?>
<h1>Edit Topic</h1>
<?php if ($err): ?><div class="alert error"><?= e($err) ?></div><?php endif; ?>
<form class="form validate" method="post">
  <input type="hidden" name="id" value="<?= $id ?>">
  <label>Topic number<input type="number" name="topic_number" min="1" required value="<?= e($t['topic_number']) ?>"></label>
  <label>Topic title<input type="text" name="topic_title" maxlength="200" required value="<?= e($t['topic_title']) ?>"></label>
  <label>Topic description<textarea name="topic_description" rows="5"><?= e($t['topic_description']) ?></textarea></label>
  <button class="btn" type="submit">Update Topic</button> <a class="btn btn-alt" href="index.php">Cancel</a>
</form>
<?php require '../includes/footer.php'; ?>
