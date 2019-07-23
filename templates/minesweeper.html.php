<?php $game = $_SESSION['game']; ?>
<table id="mineSweeper">
    <?php for($i = 0; $i < $game->getRows(); $i++): ?>
        <tr id="<?= $i ?>">
        
        <?php for($j = 0; $j < $game->getColumns(); $j++): ?>
        <td>
            <form action="?route=minesweeper/home" method="POST">
                <input type="hidden" name="row" value="<?= $i ?>">
                <input type="hidden" name="column" value="<?= $j ?>">
                <input type="submit" value="<?= $game->mines[$i][$j] ?>">
            </form>
        </td>
        <?php endfor; ?>
        
        </tr>
    <?php endfor; ?>
</table>