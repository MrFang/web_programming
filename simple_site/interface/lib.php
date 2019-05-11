<?php
    
    function render_buttons() {
        if (in_array('add_article', $_SESSION['permissions'])) {
            render_add_article_button();
        }

        if (in_array('add_category', $_SESSION['permissions'])) {
            render_add_category_button();
        }

        if (in_array('delete_category', $_SESSION['permissions'])) {
            render_delete_category_button();
        }

        render_logout_button();
    }
    
    function render_add_article_button() {
        echo
        '<form class="add-article-button" action="./addArticle.php">'.
            '<input type="submit" value="Add article"/>'.
        '</form>';
    }

    function render_add_category_button() {
        echo
        '<form class="add-category-button" action="./addCategory.php">'.
            '<input type="submit" value="Add category"/>'.
        '</form>';
    }

    function render_delete_article_button($id) {
        echo
        '<form class="delete-article-button" action="./deleteArticle.php" method="POST">'.
            '<input type="hidden" value="'.$id.'", name="id">'.
            '<input type="submit" value="Delete article"/>'.
        '</form>';
    }

    function render_delete_category_button() {
        echo
        '<form class="delete-category-button" action="./deleteCategory.php">'.
            '<input type="submit" value="Delete category"/>'.
        '</form>';
    }

    function render_edit_article_button($id) {
        echo
        '<form class="edit-articel-button" action="./editArticle.php" method="POST">'.
            '<input type="hidden" value="'.$id.'", name="id">'.
            '<input type="submit" value="Edit article"/>'.
        '</form>';
    }

    function render_logout_button() {
        echo
        '<form method="post" class="delete-category-button" action="../auth">'.
            '<input type="hidden" value="logout", name="action">'.
            '<input type="submit" value="Log Out"/>'.
        '</form>';
    }
?>