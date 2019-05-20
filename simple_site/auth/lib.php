<?php
    function render_auth_form() {
        echo 
        '<form class="auth-form" action="'.BASE_URL.'auth/" method="POST">'.
            'LOGIN: <input type="text" name="login" required/><br/>'.
            'PASSWORD: <input type="password" name="password" autocomplete="off" required/><br/>'.
            '<input type="submit" value="Log In"/>'.
        '</form>'.
        '<form action="'.BASE_URL.'register">'.
            '<input type="submit" value="Register">'.
        '</form>';
    }

    function check_auth($login, $password, $conn) {
        $res = mysql_query('SELECT password FROM users WHERE login LIKE "'.$login.'"', $conn);

        if ($password == mysql_fetch_array($res)['password']) {
            session_start();
            $_SESSION['login'] = $login;
            return true;
        } else {
            return false;
        }
    }

    function get_permissions($conn) {
        $_SESSION['permissions']=array();

        $res = mysql_query(
            'SELECT permissions.name
            FROM users_to_permissions AS map
            INNER JOIN users ON users.id = map.user_id
            INNER JOIN permissions ON permissions.id = map.permission_id
            WHERE users.login LIKE "'.$_SESSION['login'].'"',
            $conn
        );

        while($permission = mysql_fetch_array($res)) {
            $_SESSION['permissions'][] = $permission['name'];
        }
    }

    function render_register_form() {
        echo
        '<form action="'.BASE_URL.'auth/register.php", method="POST">'.
            'LOGIN: <input type="text" name="login" required/><br/>'.
            'EMAIL: <input type="text" name="email" required/><br/>'.
            'PASSWORD: <input type="password" name="password" autocomplete="off" required/></br>'.
            '<input type="submit" value="Register">'.
        '</form>';
    }

    function logout() {
        session_start();
        session_destroy();
    }
?>