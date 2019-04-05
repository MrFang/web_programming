<?php

    function render_index_page($conn) {
        render_index($conn);
    }

    function render_content_page($id, $conn) {
        render_menu($conn);
        render_content($id, $conn);
    }

    function render_index($conn) {
        $res = mysql_query('SELECT id, name, content_id FROM menu WHERE parent_id is NULL', $conn);

        echo '<div class= "index">';

        while($item = mysql_fetch_array($res)) {
            echo
            '<div class="index_item">'.
                '<a class="menu__item" href="http://students.yss.su/PSTGU/2019/zolotukhin/simple_site/index.php?id='.$item['content_id'].'">'.
                    $item['name'].
                '</a>'.
            '</div>';
        
        }

        echo '</div>';
    }

    function render_menu($conn) {
        echo '<div class= "menu">';
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

    function render_item($name, $content_id) {
        $item = 
        '<li>'.
            '<a class="menu__item" href="http://students.yss.su/PSTGU/2019/zolotukhin/simple_site/index.php?id='.$content_id.'">'.
                $name.
            '</a>'.
        '</li>';
        echo $item;
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
            render_item($item['name'], $item['content_id']);
            render_subitems($item['id'], $conn);
        }
        echo '</ul>';
    }
?>