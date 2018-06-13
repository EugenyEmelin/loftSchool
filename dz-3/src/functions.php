<?php
function task1($filename)
{
    $file = file_get_contents($filename);
    $xml = new SimpleXMLElement($file);
    echo '<pre>';
    foreach ($xml->attributes() as $attribute => $value) {
        echo $attribute . ': ' . $value . '<br>';
    }
    echo $xml->DeliveryNotes->getName() . ': ' . $xml->DeliveryNotes->__toString() . '<br>';
    echo '<h3>Addresses</h3>';
    $a = 1;
    foreach ($xml->Address as $address) {
        echo '<b>Address №' . $a++ . '</b><br>';
        echo $address->attributes()->getName() . ': ' . $address->attributes() . '<br>';
        foreach ($address as $param => $value) {
            echo "$param: $value<br>";
        }
        echo '<br>';
    }
    echo '<br>';
    echo '<h3>Packages</h3>';
    $i = 1;
    foreach ($xml->Items->Item as $item) {
        echo '<b>Package №' . $i++ . '</b><br>';
        echo $item->attributes()->getName() . ': ' . $item->attributes() . '<br>';
        foreach ($item as $param => $value) {
            echo "$param: $value<br>";
        }
        echo '<br>';
    }
}
function task2()
{
    $countries = [
      ['Швеция', 'Норвегия', 'Финляндия', 'Дания'],
      ['Германия', 'Франция', 'Италия', 'Испания'],
      ['Китай', 'США', 'Япония', 'Австралия']
    ];
    $json = json_encode($countries, JSON_UNESCAPED_UNICODE);
    file_put_contents('src/output.json', $json);

    $data =  file_get_contents('src/output.json');
    $decoded = json_decode($data, true);
    foreach ($decoded as &$countryGroup) {
        foreach ($countryGroup as &$country) {
            if (rand(0, 1)) $country .= rand(13, 42);
        }
    }
    $json2 = json_encode($decoded, JSON_UNESCAPED_UNICODE);
    file_put_contents('src/output2.json', $json2);

    $dataFile1 = file_get_contents('src/output.json');
    $dataFile2 = file_get_contents('src/output2.json');
    $array1 = json_decode($dataFile1, true);
    $array2 = json_decode($dataFile2, true);
    print_r($array1);
    echo '<br>';
    print_r($array2);
    for ($i = 0, $count = count($array1); $i < $count; $i++) {
        $resultDiff[] = array_diff($array2[$i], $array1[$i]);
    }
    echo 'Изменённые элементы:<br>';
    print_r($resultDiff);
}
function task3()
{
    $len = 50;
    for ($i = 0; $i < $len; $i++) {
        $numbers[] = rand(1, 100);
    }
    $csvFileW = fopen('src/numbers.csv', 'w');
    if ($csvFileW) {
        fputcsv($csvFileW, $numbers, ';');
    }
    fclose($csvFileW);

    $csvFileR = fopen('src/numbers.csv', 'r');
    if ($csvFileR) {
        $numbers = fgetcsv($csvFileR, 200, ';');
        $sum = 0;
        foreach ($numbers as $number) {
            if ($number % 2 === 0) $sum += $number;
        }
        echo "Сумма чётных элементов массива: $sum <br>";
    }
}
function task4($src)
{
    $content = file_get_contents($src);
    $contentData = json_decode($content, true);
    echo $content.'<br>';
    print_r($contentData);
    //Так как вложенность массива неизвестна воспользуемся рекурсивным итератором для поиска нужных ключей
    foreach (new RecursiveIteratorIterator(
        new RecursiveArrayIterator($contentData),RecursiveIteratorIterator::LEAVES_ONLY) as $key => $value) {
        if ('title' === $key) $result['title'] = $value;
        if ('pageid' === $key) $result['page_id'] = $value;
    }
     echo array_key_exists('title', $result) ?
         "title: {$result['title']} <br>" :
         'Неудалось найти название страницы<br>';
    echo array_key_exists('page_id', $result) ?
        "page_id: {$result['page_id']} <br>" :
        'Неудалось найти ID страницы<br>';
}
