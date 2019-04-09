<?php
    function init_db() {
        $conn = mysql_connect("localhost", "zolotukhin", "fn9k5dkF");
        mysql_set_charset('utf8');
        mysql_select_db("zolotukhin", $conn);
        
        return $conn;
    }

    function isLogIn() {
        return isset($_SESSION['login']) && isset($_SESSION['permissions']);
    }
?>