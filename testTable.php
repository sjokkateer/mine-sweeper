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
    <table>
        <?php for($i = 0; $i < SIZE; $i++): ?>
            <tr>
            <?php for($j = 0; $j < SIZE; $j++): ?>
                <td class="mineSweeperTd" onmousedown="printId(this.id, event);" id="<?= "({$i}, {$j})" ?>"><?= "({$i}, {$j})" ?></td>
            <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
    <script>
        function printId(id, event) {
            if (event.button === 0) {
                console.log(event.button);
                console.log(id);
            } else if (event.button === 2) {
                console.log(event.button);
                console.log(id);
            }
        }
    </script>
</body>
</html>