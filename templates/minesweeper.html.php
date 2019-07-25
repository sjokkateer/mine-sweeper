<?php $game = $_SESSION['game']; ?>
<form action="?route=minesweeper/newgame" method="POST">
    <input type="submit" value="New Game">
</form>
<br />
<br />
<div>
    <div>
        <h3># of Flags Left: <?= $game->getFlagCount() ?></h3>
    </div>
    <?php if($game->isWon()): ?>
        <div style="color: green;">
            <h4>Good Job, You Won!</h4>         
        </div>
    <?php endif; ?>
    <?php if($game->isGameOver()): ?>
        <div style="color: red;">
            <h4>You Lost!</h4>      
        </div>
    <?php endif; ?>
    <div id="mineSweeperGridDiv">
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
    <div id="legendDiv">
        <div style="margin-left: 20px;">
            <h2>Legend</h2>
            <ul style="list-style-type:none;">
                <li>* represents a mine</li>
                <li>- represents a flag <i>(can be added with a right mouse click on a cell)</i></li>
                <li># represents the number of neighboring mines to that cell</li>
            </ul>
        </div>
    </div>
</div>