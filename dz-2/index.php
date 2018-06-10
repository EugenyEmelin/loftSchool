<?php
require_once 'src/functions.php';

echo task1(['dsfdsfdsfd', 'fsdfsdds', 'sfds34234', 'fdsfdsf11']);
echo '<br>';
echo task1([1,3,3,13,'123']);
echo '<br>';
echo '<br>';
print_r(task2('+', 23, 3.3, 4, 2.22, 20));
task3(8, 12);
task4();
task5();
//Задание #6
$f = fopen('test.txt', 'w');
fwrite($f, 'Hello again!:)');
fclose($f);
task6('test.txt');
