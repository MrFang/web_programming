<?php
    header('Content-Type: text/html; charset=utf-8');
    include('./lib.php');
    include('../common.php');

    session_start();
    if (!isLogIn() || !in_array('delete_article', $_SESSION['permissions'])) {
        header('Location: ../auth');
    }

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

    if(isset($_POST['id'])) {
        mysql_query('DELETE FROM content WHERE id='.$_POST['id'], $conn);

        echo '<meta http-equiv="refresh" content="0;URL=./">';
        
    } else {
        echo 'ERROR: Undefined id';
        echo '<meta http-equiv="refresh" content="1;URL=./">';
    }

    echo '</body></html>';

    mysql_close($conn);
?>