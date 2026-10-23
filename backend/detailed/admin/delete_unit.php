<?php
require_once '../config/data.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = load_data();
    $i = unit_index($data, $_POST['id'] ?? 0);
    if ($i >= 0) { unset($data[$i]); save_data($data); }
}
go('index.php?msg=' . urlencode('Unit deleted.'));
