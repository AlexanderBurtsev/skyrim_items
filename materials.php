<?php
$file_name = '../materials.txt';
$rewrite = false;
$url = 'https://elderscrolls.fandom.com/ru/wiki/Материалы_для_изготовления_предметов_(Skyrim)';

$response = file_get_contents($url);

preg_match_all('~</td><td> <a.*?>([А-ЯA-Z]\D*?\b)</a>(<sup.*?</sup>)?\\n</td><td>~us', $response, $materials_name);
preg_match_all('~</td><td> (<a href=".*>XX</a>)?(0\w{5,7})\\n~u', $response, $materials_id);
preg_match_all('~<td> <a href="(https.+?)"~u', $response, $images);


for ($i = 0; $i < count($materials_name[1]); $i++) {
    if (strlen($materials_id[2][$i]) == 6) {
        $materials_id[2][$i] = '04' . $materials_id[2][$i];
    }
    $items[$materials_name[1][$i]] = array($materials_id[2][$i], $images[1][$i]);
}

require_once 'template.php';