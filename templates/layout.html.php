<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <title><?= $title ?></title>
</head>
<body>
    <?= $output ?>
    <br />
    <br />
    <br />
    <form action="reset.php" method="POST">
        <input type="submit" value="Reset Game">
    </form>
</body>
</html>