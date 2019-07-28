<?php
session_start();
// echo __DIR__;
// echo '<br/>';
// echo $_SERVER['HTTP_HOST'];
// echo '<br/>';
// foreach($_SERVER as $key => $var) {
//     echo "$key => $var";
//     echo '<br/>';
// }
session_unset();
session_destroy();
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/browser_games/index.php?route=sudoku/home');