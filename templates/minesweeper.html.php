<?php $game = $_SESSION['game']; ?>
<table id="mineSweeper">
    <?php for($i = 0; $i < $game->getRows(); $i++): ?>
        <tr id="<?= $i ?>">    
        <?php for($j = 0; $j < $game->getColumns(); $j++): ?>
        <td>
            <form action="?route=minesweeper/home" method="POST">
                <input type="hidden" name="row" value="<?= $i ?>">
                <input type="hidden" name="column" value="<?= $j ?>">
                <?php if($game->isClicked($i, $j)): ?>
                    <?php if($game->isGameOver() && $game->isFatalMine($i, $j)): ?>
                        <input style="background: red;" disabled class="mineSweeperCell" type="submit" value="<?= $game->mines[$i][$j] ?>">
                    <?php else: ?>
                        <input disabled class="mineSweeperCell" type="submit" value="<?= $game->mines[$i][$j] ?>">
                    <?php endif; ?>
                <?php else: ?>
                    <input class="mineSweeperCell" type="submit" value="<?= $game->mines[$i][$j] ?>">
                <?php endif; ?>
            </form>
        </td>
        <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>