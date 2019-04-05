<?php
    include('./lib.php');

    $conn = mysql_connect("localhost", "zolotukhin", "fn9k5dkF");
    mysql_select_db("zolotukhin", $conn);

    echo
    '<!DOCTYPE html>'.
    '<html>'.
        '<head>'.
            '<title>site</title>'.
            '<link rel="stylesheet"  href="style.css"/>'.
            '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">'.
        '</head>'.
        '<body>';

    if (!isset($_GET['id'])) {
        render_index_page($conn);
    } else {
        render_content_page($_GET['id'], $conn);
    }

    echo '</body></html>';
?>