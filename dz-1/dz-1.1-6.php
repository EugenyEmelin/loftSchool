<?php
//Задание #1
$name = 'Евгений';
$age = '27';

echo "Меня зовут: $name".PHP_EOL;
echo "Мне $age лет".PHP_EOL;
echo "\"!|\\/'\"\\".PHP_EOL.PHP_EOL;

//Задание #2
const PICTURES = 80; //всего рисунков
const MARKER_PICTURES = 23; //рисунков фломастером
const PENCIL_PICTURES = 40; //рисунков карандашом
$paintPictures = PICTURES - (MARKER_PICTURES + PENCIL_PICTURES);

echo 'Всего рисунков: s = '.PICTURES.PHP_EOL;
echo 'Рисунков фломастером: f = '.MARKER_PICTURES.PHP_EOL;
echo 'Рисунков карандашом:  k = '.PENCIL_PICTURES.PHP_EOL;
echo "Остальные рисунки выполнены красками: p = ?\nСколько рисунков выполнены красками?".PHP_EOL;
echo 'Решение:
    k = s - (f + p) = '.PICTURES.' - '.'('.MARKER_PICTURES.' + '.PENCIL_PICTURES.") = $paintPictures".PHP_EOL.PHP_EOL;

//Задание #3
$age = 27;
if ($age >= 18 && $age <= 65) {
    echo 'Вам ещё работать и работать';
} elseif ($age > 65) {
    echo 'Вам пора на пенсию';
} elseif ($age >= 1 && $age <= 17) {
    echo 'Вам ещё рано работать';
} else {
    echo 'Неизвестный возраст';
}
echo PHP_EOL.PHP_EOL;

//Задание #4
$day = 32;
switch ($day) {
    case ($day >= 1 && $day <= 5):
        echo 'Это рабочий день';
        break;
    case 6:
    case 7:
        echo 'Это выходной день';
        break;
    default:
        echo 'Неизвестный день';
}
echo PHP_EOL.PHP_EOL;

//Задание #5
$bmw = ['model'=>'X5', 'speed'=>120, 'doors'=>5, 'year'=>2015];
$toyota = ['model'=>'Camry', 'speed'=>130, 'doors'=>5, 'year'=>2012];
$opel = ['model'=>'Astra', 'speed'=>110, 'doors'=>5, 'year'=>2010];

$cars['bmw'] = $bmw;
$cars['toyota'] = $toyota;
$cars['opel'] = $opel;

//print_r($cars);
foreach ($cars as $car => $parameters) {
    echo "CAR $car".PHP_EOL;
    foreach ($parameters as $parameter) {
        echo $parameter . ' ';
    }
    echo PHP_EOL;
}
