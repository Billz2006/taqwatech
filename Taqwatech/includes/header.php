<?php
// header.php - bagian atas semua halaman (<head>, CSS, dan navbar)
// Sebelum di-include, halaman bisa mengisi:
//   $judul_halaman  -> judul pada tab browser
//   $css_tambahan   -> daftar file CSS tambahan dari folder css/, contoh: ['style.css']

$judul_halaman = $judul_halaman ?? 'Taqwatech';
$css_tambahan = $css_tambahan ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul_halaman ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/tema.css">
<?php foreach ($css_tambahan as $css) { ?>
    <link rel="stylesheet" href="../css/<?= $css ?>">
<?php } ?>
</head>
<body>
<?php include 'navbar.php'; ?>
