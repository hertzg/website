#!/usr/bin/php
<?php

function print_assert ($text, $status) {
    echo str_pad($text, 40, ' ')." $status\n";
}

function visual_assert ($ok, $text) {
    echo print_assert($text, $ok ? 'OK' : 'NOT OK');
}

chdir(__DIR__);

if (!function_exists('apache_get_modules')) {
    print_assert('Apache mod_rewrite enabled', 'CANNOT BE DETECTED FROM CLI');
    print_assert('Apache mod_headers enabled', 'CANNOT BE DETECTED FROM CLI');
} else {

    $apacheModules = apache_get_modules();

    $ok = in_array('mod_rewrite', $apacheModules);
    visual_assert($ok, 'Apache mod_rewrite enabled');

    $ok = in_array('mod_headers', $apacheModules);
    visual_assert($ok, 'Apache mod_headers enabled');

}

$ok = date_default_timezone_get() === 'UTC';
visual_assert($ok, 'PHP default timezone set to UTC');

$ok = function_exists('curl_init');
visual_assert($ok, 'PHP Client URL Library installed');

$ok = function_exists('imagecreatefromstring');
visual_assert($ok, 'PHP image processing and GD installed');

$ok = function_exists('mysqli_connect');
visual_assert($ok, 'PHP MySQL improved extension installed');

include_once '../fns/Users/Directory/dir.php';
$dir =  Users\Directory\dir();

$ok = is_dir($dir);
visual_assert($ok, "Data directory exists");

$file = "$dir/test";
$ok = @file_put_contents($file, 'test');
if ($ok) unlink($file);
visual_assert($ok, 'Data directory writable');
