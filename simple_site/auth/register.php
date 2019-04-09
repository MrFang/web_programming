<?php
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
            '<meta charset="utf-8">'.
        '</head>'.
        '<body>'
    ;

    if(isset($_POST['login'])) {
        mysql_query(
            'INSERT INTO users (login, email, password) VALUES
        ("'.$_POST['login'].'", "'.$_POST['email'].'", "'.md5($_POST['password']).'")',
            $conn
        );

        echo '<meta http-equiv="refresh" content="0;URL=./">';
        
    } else {
        render_register_form($conn);
    }

    echo '</body></html>';

    mysql_close($conn);
?>