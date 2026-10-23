<?php
$base = '../'; $pageTitle = 'Admin';
require '../includes/header.php';
$units = load_data();
?>
<div class="admin-top"><h1>Admin Panel</h1><a class="btn" href="add_unit.php">+ Add Unit</a></div>
<?php if (!empty($_GET['msg'])): ?><div class="alert"><?= e($_GET['msg']) ?></div><?php endif; ?>
<?php foreach ($units as $u): ?>
<section class="panel">
  <div class="admin-top">
    <h2>Unit <?= (int)$u['unit_number'] ?>: <?= e($u['title']) ?></h2>
    <div class="actions">
      <a class="btn btn-sm" href="add_topic.php?unit_id=<?= (int)$u['id'] ?>">+ Topic</a>
      <a class="btn btn-sm btn-alt" href="edit_unit.php?id=<?= (int)$u['id'] ?>">Edit</a>
      <form method="post" action="delete_unit.php" data-confirm="Delete this unit and ALL its topics?">
        <input type="hidden" name="id" value="<?= (int)$u['id'] ?>"><button class="btn btn-sm btn-danger">Delete</button>
      </form>
    </div>
  </div>
  <div class="table-wrap"><table>
    <tr><th>#</th><th>Topic</th><th>Actions</th></tr>
    <?php foreach ($u['topics'] as $t): ?>
    <tr><td><?= (int)$t['topic_number'] ?></td><td><?= e($t['topic_title']) ?></td>
      <td class="actions"><a class="btn btn-sm btn-alt" href="edit_topic.php?id=<?= (int)$t['id'] ?>">Edit</a>
        <form method="post" action="delete_topic.php" data-confirm="Delete this topic?">
          <input type="hidden" name="id" value="<?= (int)$t['id'] ?>"><button class="btn btn-sm btn-danger">Delete</button></form></td></tr>
    <?php endforeach; if (!$u['topics']): ?><tr><td colspan="3">No topics.</td></tr><?php endif; ?>
  </table></div>
</section>
<?php endforeach; ?>
<?php require '../includes/footer.php'; ?>
