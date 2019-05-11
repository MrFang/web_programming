<?php

    function render_index_page($conn) {
        render_index($conn);
    }

    function render_content_page($id, $conn) {
        render_menu($conn);
        render_content($id, $conn);
    }

    function render_index($conn) {
        $res = mysql_query('SELECT name, content_id FROM menu WHERE parent_id IS NULL', $conn);

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
        
        if (in_array('edit_article', $_SESSION['permissions']) && $id != 0) {
            render_edit_article_button($id);
        }

        if (in_array('delete_article', $_SESSION['permissions']) && $id != 0) {
            render_delete_article_button($id);
        }
    }

    function get_item($name, $content_id) {

        if($content_id == '') {
            $item = 
            '<a class="menu__item" href="./?id=0"><bold>'.
                $name.
            '</bold></a>';
        } else {
            $item = 
            '<a class="menu__item" href="./?id='.$content_id.'">'.
                $name.
            '</a>';
        }
        
        return $item;
    }

    function render_subitems($id, $conn) {
        $res = '';
        
        if ($id == 0) {
            $res = mysql_query('SELECT id, name, content_id FROM menu WHERE parent_id IS NULL', $conn);
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

    function render_add_article_form($conn) {
        $res = mysql_query('SELECT name FROM menu WHERE content_id IS NULL', $conn);
        
        // Select category
        $form =
        '<form class="add-article-form" action="./addArticle.php" method="POST">'.
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
        $form.='<input type="submit" value="Add"/></form>';

        echo $form;
    }

    function render_add_category_form($conn) {
        $res = mysql_query('SELECT name FROM menu WHERE content_id IS NULL', $conn);

        $form =
        '<form class="add-category-form" action="./addCategory.php" method="POST">'.
            'PARENT CATEGORY:
            <select name="parent" required>'.
                '<option>NONE</option>'
        ;
        
        while($item = mysql_fetch_array($res)) {
            $form.='<option>'.$item['name'].'</option>';
        }

        $form.='</select><br/>';
        $form.='NAME: <input name="name" type="text" required/><br/>';
        $form.='<input type="submit" value="Add"/></form>';
        
        echo $form;
    }

    function render_delete_category_form($conn) {
        $res = mysql_query('SELECT name FROM menu WHERE content_id IS NULL', $conn);

        $form =
        '<form class="add-category-form" action="./deleteCategory.php" method="POST">'.
            'CATEGORY: <select name="name" required>'
        ;
        
        while($item = mysql_fetch_array($res)) {
            $form.='<option>'.$item['name'].'</option>';
        }

        $form.='</select><br/>';
        $form.='<input type="submit" value="Delete"/></form>';
        
        echo $form;
    }

    function render_edit_article_form($id, $conn) {
        $name = mysql_fetch_array(mysql_query('SELECT name FROM menu WHERE content_id='.$id, $conn))['name'];
        $text = mysql_fetch_array(mysql_query('SELECT text FROM content WHERE id='.$id, $conn))['text'];

        $form =
        '<form class="add-category-form" action="./editArticle.php" method="POST">'.
            'NAME: <input type="text" name="name" required value="'.$name.'"><br/>'.
            'TEXT: <textarea name="text" reqired>'.$text.'</textarea>'.
            '<input type="hidden" name="id" value="'.$id.'">'.
            '<input type="submit" value="Edit"/>'.
        '</form>';
        
        echo $form;
    }
?>