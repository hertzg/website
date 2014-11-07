#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

include_once '../fns/mysqli_query_object.php';
$users = mysqli_query_object($mysqli, 'select * from users');

$mkdir = function ($dirname) {
    if (!is_dir($dirname)) mkdir($dirname);
    chmod($dirname, 0770);
};

include_once '../fns/get_data_dir.php';
$data_dir = get_data_dir();

$mkdir($data_dir);

$usersDir = "$data_dir/users";
$mkdir($usersDir);

$mkdir("$data_dir/contact-photos");

foreach ($users as $user) {
    $userDir = "$usersDir/$user->id_users";
    $mkdir($userDir);
    $mkdir("$userDir/files");
    $mkdir("$userDir/received-files");
    $mkdir("$userDir/received-folder-files");
}

file_put_contents("$data_dir/.htaccess", "Deny from all\n");
