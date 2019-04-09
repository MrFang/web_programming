<?php
    header('Content-Type: text/html; charset=utf-8');
    include('./lib.php');
    include('../common.php');

    $conn = init_db();

    echo
    '<!DOCTYPE html>'.
    '<html>'.
        '<head>'.
            '<title>site</title>'.
            '<link rel="stylesheet"  href="style.css"/>'.
            '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">'.
            '<meta charset="utf8">'.
        '</head>'.
        '<body>'
    ;

    if (!isset($_POST['login'])){
        render_auth_form();
    } else {

        if (check_auth($_POST['login'], md5($_POST['password']), $conn)) {
            get_permissions($conn);
            echo '<meta http-equiv="refresh" content="0;URL=../">';
        } else {
            echo 'LOGIN FAILED';
            echo '<meta http-equiv="refresh" content="1;URL=./">';
        }
    }

    echo '</body></html>';
    mysql_close($conn);
?>