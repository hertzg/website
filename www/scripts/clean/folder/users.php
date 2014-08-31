#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';
include_once '../../../lib/mysqli.php';
include_once '../../../fns/mysqli_query_object.php';
include_once '../../../fns/Users/get.php';

$microtime = microtime(true);

$deleted = 0;
include_once 'fns/for_each_user.php';
for_each_user(function ($id_users) use ($mysqli, &$deleted) {
    $user = Users\get($mysqli, $id_users);
    if (!$user) {
        system("rm -r ../../../users/$id_users");
        $deleted++;
    }
});

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $deleted file(s) deleted.\n";
