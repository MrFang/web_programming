<?php
    error_reporting(0);
    
    function multiple_matrix_by_matrix($a, $b) {
        $result = [];

        for($i = 0; $i < count($a); $i++) {
            for($j=0; $j < count($a); $j++) {
                for($k=0; $k < count($a); $k++) {
                    $result[$i][$j] += $a[$i][$k] * $b[$k][$j];
                }
            }
        }

        return $result;
    }

    $a[0][0] = 1; $a[0][1] = 2; $a[1][0] = 3; $a[1][1] = 4; 
    $b[0][0] = 1; $b[0][1] = 0; $b[1][0] = 0; $b[1][1] = 1;
    $res = multiple_matrix_by_matrix($a, $b);

    for($i = 0; $i < count($res); $i++) {
        for ($j = 0; $j < count($res); $j++) {
            echo $res[$i][$j]." ";
        }
        echo "\n";
    }
?>