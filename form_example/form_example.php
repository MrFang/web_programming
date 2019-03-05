<?php
    echo 
    '<a href="form_example.php?id=1">Test</a>';

    echo
    '<form method="POST" action="form_example.php">'.
        'id: <input type="text" name="id" size="5"/>'.
        '<input type="submit" value="Send">'.
    '</form>';

    if(isset($_GET['id'])) {
        echo
        'GET: id = '.$_GET['id'].'<br/>';
    }
    else if(isset($_POST['id'])) {
        echo
        'POST: id = '.$_POST['id'].'<br/>';
    }
    else {
        echo
        'id is undefined<br/>';
    }
?>