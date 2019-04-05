<?php
    function get_children($parent_id, $conn) {
        if ($parent_id == 0) {
            $res = mysql_query('SELECT id, name FROM tree WHERE parent_id is NULL', $conn);
        } else {
            $res = mysql_query('SELECT id, name FROM tree WHERE parent_id='.$parent_id, $conn);
        }

        while ($tree = mysql_fetch_array($res)) {
            echo $tree['name'];
        }
    }

    $conn = mysql_connect('localhost', 'zolotukhin', 'fn9k5dkF');
    mysql_select_db('zolotukhin', $conn);
    get_children(0, $conn);
?>