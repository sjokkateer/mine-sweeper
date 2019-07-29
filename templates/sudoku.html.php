<?php 
$game = $_SESSION['sudoku'];
?>
<form action="?route=sudoku/home" method="post">
    <table>
        <tbody>
            <?php for($i = 0; $i < $game->getRows(); $i++): ?>
                <?php if($i + 1 != $game->getRows() && ($i + 1) % 3 === 0): ?>
                    <tr id="<?= $i ?>" class="border_bottom">
                <?php else: ?>
                    <tr id="<?= $i ?>">
                <?php endif; ?>
                <?php for($j = 0; $j < $game->getColumns(); $j++): ?>
                    <?php if($j + 1 != $game->getColumns() && ($j + 1) % 3 === 0): ?>
                        <td id="<?= $j ?>" class="border_right">
                    <?php else: ?>
                        <td id="<?= $j ?>">
                    <?php endif; ?>
                    <!-- If the value != between 1 and 9, display an input field -->
                        <?php if($game->getValue($i, $j) >= 1 &&  $game->getValue($i, $j) <= 9): ?>
                            <?= $game->getValue($i, $j) ?>
                    <!-- Else display the value -->
                        <?php else: ?>
                            <input type="number" name="" min="1" max="9">
                        <?php endif; ?>
                    </td>
                <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
    <input type="submit" value="Check Solution">
</form>

<br/>
<br/>
<br/>

<?= $game->printIndices() ?>