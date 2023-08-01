<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?php
        /** @var string $title */
        echo $title;
        ?>
    </title>
    <link rel="stylesheet" href="./public/css/reset.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <link href="./public/img/favicon.ico" rel="icon" type="image/x-icon" />
    <script src="./vendor/apexcharts/apexcharts.js"></script>
<body>
<?php
/** @var string $content */
echo $content;
?>
<footer>
    <div class="logo-fm"></div>
    Copyright (c) <?php echo date('Y') ?> MrKrasnov/FinanceMaster
</footer>
<script src="./public/js/main.js"></script>
</body>
</html>