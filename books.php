<?php
$file_name = '../books.txt';
$rewrite = false;
$url = 'https://elderscrolls.fandom.com/ru/wiki/ID_книг_и_документов_(Skyrim)';
$image = 'https://vignette.wikia.nocookie.net/elderscrolls/images/8/8f/Книга_Skyrim_5.png/revision/latest/scale-to-width-down/64?cb=20120923090344&path-prefix=ru';

$response = file_get_contents($url);
$unknown_book = [
    'Неизвестная книга, т. I'   => '0401A3E0',
    'Неизвестная книга, т. II'  => '0401A3E1',
    'Неизвестная книга, т. III' => '0401A3E2',
    'Неизвестная книга, т. IV'  => '0401A3E3',
];

preg_match_all('~<td> <a.*?>(.+?)</a>(<sup>.*?</sup>)?~u', $response, $books_name);
preg_match_all('~((\w{6,8})</code>)|(см.статью)\\n~u', $response, $books_id);

for ($i = 0; $i < count($books_name[1]); $i++) {
    if (strlen($books_id[2][$i]) == 6) {
        $books_id[2][$i] = '04' . $books_id[2][$i];
    }
    if ($books_id[2][$i] == '') {
        foreach ($unknown_book as $key => $value) {
            $items[$key] = array($value, $image);
        }
        continue;
    }

    $items[$books_name[1][$i]] = array($books_id[2][$i], $image);
}

require_once 'template.php';