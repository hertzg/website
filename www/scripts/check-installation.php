#!/usr/bin/php
<?php

function visual_assert ($ok, $text) {
    $ok = $ok ? 'OK' : 'NOT OK';
    echo str_pad($text, 30, ' ')." $ok\n";
}

chdir(__DIR__);
include_once '../../lib/cli.php';

$ok = date_default_timezone_get() === 'UTC';
visual_assert($ok, 'Default Timezone UTC');

$ok = function_exists('curl_init');
visual_assert($ok, 'PHP Client URL Library');

$ok = function_exists('imagecreatefromstring');
visual_assert($ok, 'PHP Image Processing and GD');

$ok = function_exists('mysqli_connect');
visual_assert($ok, 'PHP MySQL Improved Extension');

include_once '../fns/Users/Directory/dir.php';
$dir =  Users\Directory\dir();

$ok = is_dir($dir);
visual_assert($ok, "Data directory exists");

$file = "$dir/test";
$ok = file_put_contents($file, 'test');
if ($ok) unlink($file);
visual_assert($ok, 'Data directory writable');
