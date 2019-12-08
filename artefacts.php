<?php
$file_name = '../artefacts.txt';
$rewrite = false;
$url = 'https://elderscrolls.fandom.com/ru/wiki/Даэдрические_артефакты_(Skyrim)';

$response = file_get_contents($url);

preg_match_all('~<td style="width: 35%; text-align: center;"> <a.*?>(.{0,30})<\/a> \((\w{8})\)~u', $response, $matches);
preg_match_all('~<td rowspan="2".*?data-src="(.+?)"~u', $response, $images);

for ($i = 0; $i < count($matches[1]); $i++) {
    $items[$matches[1][$i]] = array($matches[2][$i], $images[1][$i]);
}

require_once 'template.php';