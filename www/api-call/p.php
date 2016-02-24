<?php

$lines = explode("\n", file_get_contents('list'));
array_pop($lines);
foreach ($lines as $line) {
    $content = file_get_contents($line);
    $method = substr($line, 0, strlen($line) - 4);
    $content = preg_replace('/require_api_key\(/', "require_api_key('$method', ", $content);
    file_put_contents($line, $content);
}

