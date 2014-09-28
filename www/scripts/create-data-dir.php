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

$dataDir = '../data';
$mkdir($dataDir);

$usersDir = "$dataDir/users";
$mkdir($usersDir);

$mkdir("$dataDir/contact-photos");

foreach ($users as $user) {
    $userDir = "$usersDir/$user->id_users";
    $mkdir($userDir);
    $mkdir("$userDir/files");
    $mkdir("$userDir/received-files");
    $mkdir("$userDir/received-folder-files");
}

file_put_contents("$dataDir/.htaccess", "Deny from all\n");
