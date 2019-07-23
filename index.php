<?php
const SIZE = 6;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <title>Table</title>
</head>
<body>
    <form action="result.php" method="POST">
        <table id="mineSweeper">
            <?php for($i = 0; $i < SIZE; $i++): ?>
                <tr id="<?= $i ?>">
                <?php for($j = 0; $j < SIZE; $j++): ?>
                    <td>
                        <input type="hidden" name="row" value="<?= $i ?>">
                        <input type="hidden" name="column" value="<?= $i ?>">
                        <input type="submit" value="">
                    </td>
                <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>
    </form>
</body>
</html>