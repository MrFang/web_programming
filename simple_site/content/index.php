<?php
    header('Content-Type: text/html; charset=utf-8');
    include('./lib.php');
    include('../common.php');

    session_start();
    if (!isLogIn()) {
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

    if (!isset($_GET['id'])) {
        render_index_page($conn);
    } else {
        render_content_page($_GET['id'], $conn);
    }

    if (in_array('add_article', $_SESSION['permissions'])) {
        render_add_button();
    }

    echo '</body></html>';
    mysql_close($conn)
?>