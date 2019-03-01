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

    function render_table($values, $class_name) {
        $result = '<table class= "'.$class_name.'">';

        for($i = 0; $i < count($values); $i++) {
            $result.="<tr>";

            for($j = 0; $j < count($values[0]); $j++) {
                $result.="<td>".(string)$values[$i][$j]."</td>";
            }

            $result.="</tr>";
        }

        $result.="</table>";

        return $result;
    }

    function render() {
        $a[0][0] = 1; $a[0][1] = 2; $a[1][0] = 3; $a[1][1] = 4; 
        $b[0][0] = 1; $b[0][1] = 0; $b[1][0] = 0; $b[1][1] = 1;
        
        $result =
        '<html>
            <head>
                <title>Multiple Matrix By Matrix</title>
                <link rel="stylesheet"  href="style.css"/>
            </head>
            <body>';

            $result.=render_table($a, 'matrix');
            $result.=' * ';
            $result.=render_table($b, 'matrix');
            $result.=' = ';
            $result.=render_table(multiple_matrix_by_matrix($a, $b), 'matrix');

            $result.='</body></html>';

            return $result;
    }

    echo render();

?>