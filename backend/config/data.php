<?php
// Flat-file storage: all syllabus data lives in data/syllabus.json (no database needed)
define('DATA_FILE', __DIR__ . '/../data/syllabus.json');
function load_data() {
    $d = json_decode((string)@file_get_contents(DATA_FILE), true);
    if (!is_array($d)) $d = [];
    usort($d, function ($a, $b) { return $a['unit_number'] <=> $b['unit_number']; });
    foreach ($d as &$u) { usort($u['topics'], function ($a, $b) { return $a['topic_number'] <=> $b['topic_number']; }); }
    return $d;
}
function save_data($d) {
    return file_put_contents(DATA_FILE, json_encode(array_values($d), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}
function unit_index($d, $id) { foreach ($d as $i => $u) if ((int)$u['id'] === (int)$id) return $i; return -1; }
function topic_index($d, $tid) {
    foreach ($d as $i => $u) foreach ($u['topics'] as $j => $t) if ((int)$t['id'] === (int)$tid) return [$i, $j];
    return [-1, -1];
}
function next_topic_id($d) { $m = 0; foreach ($d as $u) foreach ($u['topics'] as $t) $m = max($m, $t['id']); return $m + 1; }
function unit_number_taken($d, $n, $exceptId = 0) { foreach ($d as $u) if ($u['unit_number'] == $n && $u['id'] != $exceptId) return true; return false; }
function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function clean($s, $max) { return mb_substr(trim(strip_tags((string)$s)), 0, $max); }
function go($url) { header("Location: $url"); exit; }
