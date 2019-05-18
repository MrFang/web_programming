<?php
    header('Content-Type: text/html; charset=utf-8');
    include('../common.php');
    include('./lib.php');
    include('../interface/lib.php');

    session_start();
    if (!isLogIn()) {
        echo '<meta http-equiv="refresh" content="0;URL='.BASE_URL.'auth/">';
    }

    $conn = init_db();

    echo
    '<!DOCTYPE html>'.
    '<html>'.
        '<head>'.
            '<title>site</title>'.
            '<link rel="stylesheet"  href="'.BASE_URL.'content/style.css"/>'.
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

    render_buttons();

    echo '</body></html>';
    mysql_close($conn)
?>