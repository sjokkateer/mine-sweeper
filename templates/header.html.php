<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <?php foreach($styleSheets as $styleSheet): ?>
        <link rel="stylesheet" href="<?= 'css/' . $styleSheet ?>">
    <?php endforeach; ?>
    <title><?= $title ?></title>
</head>
<body>