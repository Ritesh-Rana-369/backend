<?php
$base = '../'; $pageTitle = 'Edit Unit';
require_once '../config/data.php';
$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$data = load_data();
$i = unit_index($data, $id);
if ($i < 0) go('index.php?msg=' . urlencode('Unit not found.'));
$u = $data[$i];
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n = (int)($_POST['unit_number'] ?? 0); $t = clean($_POST['title'] ?? '', 150); $d = clean($_POST['description'] ?? '', 2000);
    if ($n < 1 || $t === '') $err = 'Unit number and title are required.';
    elseif (unit_number_taken($data, $n, $id)) $err = 'That unit number already exists.';
    else {
        $data[$i]['unit_number'] = $n; $data[$i]['title'] = $t; $data[$i]['description'] = $d;
        save_data($data);
        go('index.php?msg=' . urlencode('Unit updated.'));
    }
    $u = array_merge($u, ['unit_number' => $n, 'title' => $t, 'description' => $d]);
}
require '../includes/header.php';
?>
<h1>Edit Unit</h1>
<?php if ($err): ?><div class="alert error"><?= e($err) ?></div><?php endif; ?>
<form class="form validate" method="post">
  <input type="hidden" name="id" value="<?= $id ?>">
  <label>Unit number<input type="number" name="unit_number" min="1" required value="<?= e($u['unit_number']) ?>"></label>
  <label>Unit title<input type="text" name="title" maxlength="150" required value="<?= e($u['title']) ?>"></label>
  <label>Description<textarea name="description" rows="4"><?= e($u['description']) ?></textarea></label>
  <button class="btn" type="submit">Update Unit</button> <a class="btn btn-alt" href="index.php">Cancel</a>
</form>
<?php require '../includes/footer.php'; ?>
