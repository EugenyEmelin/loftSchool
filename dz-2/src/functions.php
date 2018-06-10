<?php
function task1(array $strings, $concatString = false)
{
    if ($concatString === true) return implode(" ", $strings);
    foreach ($strings as $string) echo "<p>$string</p>";
}
function task2($operator, ...$numbers)
{
    //-----Начало блока отлова ошибок----//
    $error = false;
    $errorMsg = '';
    if (!preg_match('/^[\+,\-,\*,\/]$/', $operator)) {
        $error = true;
        $errorMsg .= 'Некорректный оператор.<br>';
    } elseif (count($numbers) === 0) {
        $error = true;
        return $errorMsg .= 'Данные отсутствуют<br>';
    }
    foreach($numbers as $number) {
        if (!is_int($number) && !is_float($number)) {
            $error = true;
            return $errorMsg .= 'В качестве аргументов допустимы только целые и десятичные числа.<br>';
            break;
        }
    }
    //-----Конец блока отлова ошибок----//

    if (!$error) {
        for ($i=0, $count = count($numbers); $i < $count; $i++) {
            //На первой итерации записываем в результат первое число из наших аргументов и больше ничего не делаем
            if (!isset($result)) {
                $result = $numbers[0];
                continue;
            }
            switch ($operator) {
                case '-': $result -= $numbers[$i];
                    break;
                case '+': $result += $numbers[$i];
                    break;
                case '*': $result *= $numbers[$i];
                    break;
                case '/': $result /= $numbers[$i];
                    break;
            }
        }
        return implode(' '.$operator.' ', $numbers) . ' = ' . $result . '<br><br>';

    } else {
        return $errorMsg;
    }
}
function task3($num1, $num2)
{
    if (!is_int($num1) || !is_int($num2) || $num1 <= 0 || $num2 <= 0) {
        echo 'Допустимы только целые положительные числа';
        return;
    }
    echo '<table border="1" cellspacing="0" cellpadding="15">';
    echo '<tr>';
    echo '<th bgcolor=\'#add8e6\'></th>';
    for ($h = 1; $h <= $num1; $h++) {
        echo "<th bgcolor='#add8e6'>$h</th>";
    }
    echo '</tr>';
    for ($i = 1; $i <= $num2; $i++) {
        echo '<tr>';
        echo "<th bgcolor='#add8e6' width='21'>$i</th>";
        for ($j = 1; $j <= $num1; $j++) {
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
    echo '<br><br>';
}
function task4()
{
   echo date('d.m.Y H:i');
   echo '<br>';
   echo mktime(00,00,00, 02, 24, 2016);
   echo '<br><br>';
}
function task5()
{
    $string1 = 'Карл у Клары украл Кораллы';
    $string2 = 'Две бутылки лимонада';
    echo strtr($string1, ['К' => '']);
    echo '<br>';
    echo strtr($string2, ['Две' => 'Три']);
    echo '<br><br>';
}
function task6($filename)
{
    echo is_readable($filename) ? file_get_contents($filename) : 'Не удалось открыть и прочитать файл';
}
