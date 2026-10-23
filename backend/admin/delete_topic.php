<?php
require_once '../config/data.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = load_data();
    list($ui, $ti) = topic_index($data, $_POST['id'] ?? 0);
    if ($ui >= 0) { unset($data[$ui]['topics'][$ti]); $data[$ui]['topics'] = array_values($data[$ui]['topics']); save_data($data); }
}
go('index.php?msg=' . urlencode('Topic deleted.'));
