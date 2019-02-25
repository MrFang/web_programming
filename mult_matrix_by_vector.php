<?php
    error_reporting(0);

    function multiple_matrix_by_vector($matrix, $vector) {
        $result = [];

        for($i = 0; $i < count($matrix); $i++) {
            for($j = 0; $j < count($vector); $j++) {
                $result[$i]+=$matrix[$i][$j] * $vector[$j];
            }
        }

        return $result;
    }

    $matrix[0][0] = 1; $matrix[0][1] = 0; $matrix[1][0] = 0; $matrix[1][1] = 1;
    $vector[0] = 1; $vector[1] = 2;
    $res = multiple_matrix_by_vector($matrix, $vector);

    for($i = 0; $i < count($res); $i++) {
        echo $res[$i]."\n";
    }
?>
