<?php
    header('Content-Type: text/html; charset=utf-8');
    include('../common.php');
    include('./lib.php');

    session_start();
    if (!isLogIn() || !in_array('edit_article', $_SESSION['permissions'])) {
        echo '<meta http-equiv="refresh" content="0;URL='.BASE_URL.'auth/">';
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

    if(isset($_POST['name'])) {
        mysql_query('UPDATE content SET text="'.$_POST['text'].'" WHERE id='.$_POST['id'], $conn);
        mysql_query('UPDATE menu SET name="'.$_POST['name'].'" WHERE content_id='.$_POST['id'], $conn);

        echo '<meta http-equiv="refresh" content="0;URL='.BASE_URL.'">';
        
    } else if (isset($_POST['id'])) {
        render_edit_article_form($_POST['id'], $conn);
    } else {
        echo 'ERROR: Undefined id';
        echo '<meta http-equiv="refresh" content="1;URL='.BASE_URL.'">';
    }

    echo '</body></html>';

    mysql_close($conn);
?>