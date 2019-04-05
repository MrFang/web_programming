<?php
    $conn = mysql_connect("localhost", "zolotukhin", "fn9k5dkF");
    mysql_select_db("zolotukhin", $conn);
    $sql_result = mysql_query("SELECT * FROM people", $conn);

    echo '<table class="people">';
    while ($arr = mysql_fetch_array($sql_result)) {
        echo 
        '<tr>'.
            '<td>'.$arr['id'].'</td>'.
            '<td>'.$arr['name'].'</td>'.
            '<td>'.$arr['text'].'</td>'.
        '</tr>';
    }
    echo '</table>';

    mysql_free_result($sql_result);
    mysql_close($conn);
?>