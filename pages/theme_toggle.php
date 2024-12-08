<?php
session_start();
if (isset($_SESSION['theme'])) {
    if ($_SESSION['theme'] == 'dark') {
        $_SESSION['theme'] = 'light';
    } else if ($_SESSION['theme'] == 'light') {
        $_SESSION['theme'] = 'dark';
    }
} else {
    $_SESSION['theme'] = 'dark';
}
var_dump($_GET['url']);
header("Location: {$_GET['url']}");