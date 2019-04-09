<?php
    include('./common.php');

    session_start();
    if (!isLogIn()) {
        header('Location: ./auth');
    }

    header('Location: ./content');
?>