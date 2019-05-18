<?php
    include('./common.php');

    session_start();
    if (!isLogIn()) {
        echo '<meta http-equiv="refresh" content="0;URL='.BASE_URL.'auth/">';
    }

    echo '<meta http-equiv="refresh" content="0;URL='.BASE_URL.'main">';
?>