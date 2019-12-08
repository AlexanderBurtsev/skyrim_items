<?php
$file_name = '../masks.txt';
$rewrite = false;
$url = 'https://elderscrolls.fandom.com/ru/wiki/Маски_драконьих_жрецов';

$response = file_get_contents($url);

preg_match_all('~<\/td><td.*?<a.*>([А-Я].*?)<\/a>\\n~u', $response, $masks_name);
preg_match_all('~ID: (.*\/a>)?(.*?)<br~u', $response, $masks_id);
preg_match_all('~<td rowspan="2">.*src="(.*?)"~u', $response, $images);

for ($i = 0; $i < count($masks_name[1]); $i++) {
    if ($masks_name[1][$i] == 'Мирак') {
        $masks_id[2][$i] = '04039D2F';
    } else if (strlen($masks_id[2][$i]) != 8) {
        $masks_id[2][$i] = '04' . $masks_id[2][$i];
    }
    $items[$masks_name[1][$i]] = array($masks_id[2][$i], $images[1][$i]);
}

require_once 'template.php';