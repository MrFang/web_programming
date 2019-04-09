<?php

    function render_index_page($conn) {
        render_index($conn);
    }

    function render_content_page($id, $conn) {
        render_menu($conn);
        render_content($id, $conn);
    }

    function render_index($conn) {
        $res = mysql_query('SELECT name, content_id FROM menu WHERE parent_id is NULL', $conn);

        echo '<div class= "index">';

        while($item = mysql_fetch_array($res)) {
            echo 
            '<div class="index_item">'.
                get_item($item['name'], $item['content_id']).
            '</div>';
        
        }

        echo '</div>';
    }

    function render_menu($conn) {
        echo '<div class="menu">';
        render_subitems(0, $conn);
        echo '</div>';
    }

    function render_content($id, $conn) {
        $content = mysql_query('SELECT text FROM content WHERE id='.$id, $conn);
        $result = '<div class="content">';

        while($text = mysql_fetch_array($content)) {
            $result .= $text['text'];
        }

        $result .= '</div>';

        echo $result;
    }

    function get_item($name, $content_id) {
        $item = 
        '<a class="menu__item" href="./?id='.$content_id.'">'.
            $name.
        '</a>';
        
        return $item;
    }

    function render_subitems($id, $conn) {
        $res = '';
        
        if ($id == 0) {
            $res = mysql_query('SELECT id, name, content_id FROM menu WHERE parent_id is NULL', $conn);
        } else {
            $res = mysql_query('SELECT id, name, content_id FROM menu WHERE parent_id='.$id, $conn);
        }

        echo '<ul>';
        
        while($item = mysql_fetch_array($res)) {
            echo
            '<li>'.
                get_item($item['name'], $item['content_id']).
            '</li>';

            render_subitems($item['id'], $conn);
        }
        echo '</ul>';
    }

    function render_add_button() {
        echo
        '<form class="add-button" action="./add.php">'.
            '<input type="submit", value="Add article"/>'.
        '</form>';
    }

    function render_add_form($conn) {
        $res = mysql_query('SELECT name FROM menu WHERE parent_id is NULL', $conn);
        
        // Select category
        $form =
        '<form class="add-form" action="./add.php" method="POST">'.
            'CATEGORY: <select name="category" required>'
        ;

        while($item = mysql_fetch_array($res)) {
            $form.='<option>'.$item['name'].'</option>';
        }

        $form.='</select><br/>';

        //Text field
        $form.='NAME: <input name="name" type="text" required/><br/>';
        $form.='TEXT: <textarea name="text" required></textarea><br/>';

        //Submit button
        $form.='<input type="submit" value="Add"/>';

        echo $form;
    }
?>