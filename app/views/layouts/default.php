<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title><?php echo $title; ?></title>
    <link rel="stylesheet" href="./public/css/reset.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <script src="./vendor/apexcharts/apexcharts.js"></script>
</head>
<body>
<?php echo $content; ?>
<footer>
    <div class="logo-fm"></div>
    Copyright (c) <?php echo date('Y') ?> MrKrasnov/FinanceMaster
</footer>
<script src="./public/js/main.js"></script>
</body>
</html>