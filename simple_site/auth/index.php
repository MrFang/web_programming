<?php
    header('Content-Type: text/html; charset=utf-8');
    include('../common.php');
    include('./lib.php');
    
    $conn = init_db();
    
    echo
    '<!DOCTYPE html>'.
    '<html>'.
        '<head>'.
            '<title>site</title>'.
            '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">'.
            '<meta charset="utf8">'.
        '</head>'.
    '<body>'
    ;
     
    if(isset($_POST['action']) && $_POST['action'] == 'logout') {
        logout();
    };

    if (!isset($_POST['login'])){
        render_auth_form();
    } else {

        if (check_auth($_POST['login'], md5($_POST['password']), $conn)) {
            get_permissions($conn);
            echo '<meta http-equiv="refresh" content="0;URL='.BASE_URL.'">';
        } else {
            echo 'LOGIN FAILED';
            echo '<meta http-equiv="refresh" content="1;URL='.BASE_URL.'auth/">';
        }
    }

    echo '</body></html>';
    mysql_close($conn);
?>