<?php
const SIZE = 6;
?>
<table id="mineSweeper">
    <?php for($i = 0; $i < SIZE; $i++): ?>
        <tr id="<?= $i ?>">
        
        <?php for($j = 0; $j < SIZE; $j++): ?>
        <td>
            <form action="result.php" method="POST">
                <input type="hidden" name="row" value="<?= $i ?>">
                <input type="hidden" name="column" value="<?= $j ?>">
                <input type="submit" value="">
            </form>
        </td>
        <?php endfor; ?>
        
        </tr>
    <?php endfor; ?>
</table>