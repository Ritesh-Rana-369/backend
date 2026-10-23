<?php
$base = '../'; $pageTitle = 'Add Unit';
require_once '../config/data.php';
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = load_data();
    $n = (int)($_POST['unit_number'] ?? 0); $t = clean($_POST['title'] ?? '', 150); $d = clean($_POST['description'] ?? '', 2000);
    if ($n < 1 || $t === '') $err = 'Unit number and title are required.';
    elseif (unit_number_taken($data, $n)) $err = 'That unit number already exists.';
    else {
        $id = 1; foreach ($data as $u) $id = max($id, $u['id'] + 1);
        $data[] = ['id' => $id, 'unit_number' => $n, 'title' => $t, 'description' => $d, 'topics' => []];
        if (save_data($data) === false) $err = 'Could not write data/syllabus.json (check folder permissions).';
        else go('index.php?msg=' . urlencode('Unit added.'));
    }
}
require '../includes/header.php';
?>
<h1>Add Unit</h1>
<?php if ($err): ?><div class="alert error"><?= e($err) ?></div><?php endif; ?>
<form class="form validate" method="post">
  <label>Unit number<input type="number" name="unit_number" min="1" required value="<?= e($_POST['unit_number'] ?? '') ?>"></label>
  <label>Unit title<input type="text" name="title" maxlength="150" required value="<?= e($_POST['title'] ?? '') ?>"></label>
  <label>Description<textarea name="description" rows="4"><?= e($_POST['description'] ?? '') ?></textarea></label>
  <button class="btn" type="submit">Save Unit</button> <a class="btn btn-alt" href="index.php">Cancel</a>
</form>
<?php require '../includes/footer.php'; ?>
