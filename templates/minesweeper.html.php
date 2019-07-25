<?php $game = $_SESSION['game']; ?>
<form action="?route=minesweeper/newgame" method="POST">
    <input type="submit" value="New Game">
</form>
<br />
<br />
<div>
    <div>
        <table id="mineSweeper">
            <?php for($i = 0; $i < $game->getRows(); $i++): ?>
                <tr id="<?= $i ?>">    
                <?php for($j = 0; $j < $game->getColumns(); $j++): ?>
                <td>
                    <form action="?route=minesweeper/home" method="POST">
                        <input type="hidden" name="row" value="<?= $i ?>">
                        <input type="hidden" name="column" value="<?= $j ?>">
                        <input type="hidden" name="flagged" value="<?= $game->getCell($i, $j)->isFlagged() ?>">
                        <?php if($game->isGameOver() || $game->isClicked($i, $j)): ?>
                            <?php if($game->isGameOver() && $game->isFatalMine($i, $j)): ?>
                                <input style="background: red;" disabled class="mineSweeperCell" type="submit" value="<?= $game->getCell($i, $j) ?>">
                            <?php else: ?>
                                <input disabled class="mineSweeperCell" type="submit" value="<?= $game->getCell($i, $j) ?>">
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if($game->getCell($i, $j)->isFlagged()): ?>
                                <input class="mineSweeperCell" type="submit" value="-">
                            <?php else: ?>
                                <input class="mineSweeperCell" type="submit" value="<?= $game->getCell($i, $j) ?>">
                            <?php endif; ?>    
                        <?php endif; ?>
                    </form>
                </td>
                <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
    <div>
        <h2>Legend</h2>
    </div>
</div>