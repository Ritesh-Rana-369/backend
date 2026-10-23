<?php require_once __DIR__ . '/../config/data.php'; $base = $base ?? ''; $pageTitle = $pageTitle ?? 'Backend Syllabus'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?> | Backend Syllabus Portal</title>
<link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
<script src="<?= $base ?>assets/js/script.js" defer></script>
</head>
<body>
<header class="site-header">
  <div class="wrap nav-bar">
    <a class="brand" href="<?= $base ?>index.php">📘 Backend Syllabus</a>
    <nav id="mainNav" class="main-nav">
      <a href="<?= $base ?>index.php">Home</a>
      <a href="<?= $base ?>index.php#units">Units</a>
      <a href="<?= $base ?>search.php">Search</a>
      <a href="<?= $base ?>admin/">Admin</a>
    </nav>
    <button id="themeToggle" class="icon-btn" type="button" aria-label="Toggle theme">🌙 Dark</button>
    <button id="menuToggle" class="icon-btn menu-btn" type="button" aria-label="Menu">☰</button>
  </div>
</header>
<main class="wrap">
