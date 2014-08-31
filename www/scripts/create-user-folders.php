#!/usr/bin/php
<?php

chdir(__DIR__);
include_once 'lib/require-cli.php';
include_once '../lib/mysqli.php';

include_once '../fns/mysqli_query_object.php';
$users = mysqli_query_object($mysqli, 'select * from users');

$mkdir = function ($dirname) {
    if (!is_dir($dirname)) mkdir($dirname);
    chmod($dirname, 0770);
};

$mkdir('../users');
foreach ($users as $user) {
    $userDir = "../users/$user->id_users";
    $mkdir($userDir);
    $mkdir("$userDir/files");
    $mkdir("$userDir/received-files");
    $mkdir("$userDir/received-folder-files");
}
