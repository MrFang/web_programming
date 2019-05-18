<?php
    header('Content-Type: text/html; charset=utf-8');
    include('../common.php');
    include('./lib.php');

    session_start();
    if (!isLogIn() || !in_array('add_category', $_SESSION['permissions'])) {
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
        
        $parent_id = $_POST['parent'] == 'NONE' ? 'NULL' : mysql_fetch_array(
            mysql_query('SELECT id FROM menu WHERE name LIKE "'.$_POST['parent'].'"', $conn)
        )['id'];
        
        mysql_query(
            'INSERT INTO menu (parent_id, name) VALUES
            ('.$parent_id.', "'.$_POST['name'].'")',
            $conn
        );

        echo '<meta http-equiv="refresh" content="0;URL='.BASE_URL.'">';
        
    } else {
        render_add_category_form($conn);
    }

    echo '</body></html>';

    mysql_close($conn);
?>