<?php
//Задание #6
echo '<table border="1" cellspacing="0" cellpadding="15">';
echo '<tr>';
echo '<th bgcolor=\'#add8e6\'></th>';
for ($h=1; $h<10; $h++) {
    echo "<th bgcolor='#add8e6'>$h</th>";
}
echo '</tr>';
for ($i=1; $i<10; $i++) {
    echo '<tr>';
    echo "<th bgcolor='#add8e6' width='21'>$i</th>";
    for ($j=1; $j<10; $j++) {
        echo '<td align="center">';
        if ($i%2 == 0 && $j%2 == 0) {
            echo '('.$i * $j.')';
        } elseif ($i%2 != 0 && $j%2 != 0) {
            echo '['.$i * $j.']';
        } else {
            echo $i * $j;
        }
        echo '</td>';
    }
    echo '</tr>';
}
echo '</table>';
