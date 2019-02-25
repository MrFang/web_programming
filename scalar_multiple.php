<?php
    function scalar_multiple ($a, $b) {
        $result = 0;
        for($i = 0; $i < count($a); $i++) {
            $result += $a[$i] * $b[$i];
        }

        return $result;
    }

    echo scalar_multiple(array(1, 2, 3), array(1, 2, 3))."\n";
?>