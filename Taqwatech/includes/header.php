<?php
$judul_halaman = $judul_halaman ?? 'Taqwatech';
$css_tambahan = $css_tambahan ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul_halaman ?></title>
    <script src="/asset/js/tema-mode.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/tema.css">
<?php foreach ($css_tambahan as $css) { ?>
    <link rel="stylesheet" href="/css/<?= $css ?>">
<?php } ?>
</head>
<body>
<?php include __DIR__ . '/navbar.php'; ?>