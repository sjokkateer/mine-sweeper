<?php
session_start();
session_unset();
session_destroy();
header('Location: ' . __DIR__ . '/index.php?route=sudoku/home');