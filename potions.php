<?php
$file_name = '../potions.txt';
$rewrite = false;
$url = 'https://elderscrolls.fandom.com/ru/wiki/Зелья_(Skyrim)';

$response = file_get_contents($url);

preg_match_all('~</td><td>(<a.*>)?([А-ЯA-Z]\D*?\b)(</a>)?(<sup>.*?</sup>)?\\n~u', $response, $potions_name);
preg_match_all('~</td><td>(<a href=".*>XX</a>)?(0\w{5,7})\\n~u', $response, $potions_id);
preg_match_all('~<td><a href="(https.+?)"~u', $response, $images);

for ($i = 0; $i < count($potions_name[2]); $i++) {
    if (strlen($potions_id[2][$i]) == 7) {
        $potions_id[2][$i] = '0' . $potions_id[2][$i];
    }
    if (strlen($potions_id[2][$i]) == 6) {
        $potions_id[2][$i] = '04' . $potions_id[2][$i];
    }
    $items[$potions_name[2][$i]] = array($potions_id[2][$i], $images[1][$i]);
}

require_once 'template.php';