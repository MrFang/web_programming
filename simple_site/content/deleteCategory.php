<?php

    function delete_category($id, $conn) {
        $res = mysql_query('SELECT id FROM menu WHERE content_id IS NULL AND parent_id='.$id, $conn);

        while ($item = mysql_fetch_array($res)) {
            delete_category($item['id'], $conn);
        }

        $res = mysql_query('SELECT content_id AS id FROM menu WHERE content_id IS NOT NULL AND parent_id='.$id, $conn);

        while ($item = mysql_fetch_array($res)) {
            mysql_query('DELETE FROM content WHERE id='.$item['id'], $conn);

        }

        mysql_query('DELETE FROM menu WHERE id='.$id, $conn);
    }

    header('Content-Type: text/html; charset=utf-8');
    include('../common.php');
    include('./lib.php');

    session_start();
    if (!isLogIn() || !in_array('delete_category', $_SESSION['permissions'])) {
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
        
        $id = mysql_fetch_array(mysql_query('SELECT id FROM menu WHERE content_id IS NULL AND name LIKE "'.$_POST['name'].'"', $conn))['id'];
        
        delete_category($id, $conn);

        echo '<meta http-equiv="refresh" content="0;URL='.BASE_URL.'">';
        
    } else {
        render_delete_category_form($conn);
    }

    echo '</body></html>';

    mysql_close($conn);
?>