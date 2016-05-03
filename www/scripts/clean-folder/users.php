#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/cli.php';
include_once '../../../lib/defaults.php';
include_once '../../lib/mysqli.php';
include_once '../../fns/mysqli_query_object.php';
include_once '../../fns/Users/get.php';
include_once '../../fns/Users/Directory/path.php';

$microtime = microtime(true);

$deleted = 0;
include_once 'fns/for_each_user.php';
for_each_user(function ($id_users) use ($mysqli, &$deleted) {
    $user = Users\get($mysqli, $id_users);
    if (!$user) {
        $path = Users\Directory\path($id_users);
        system("rm -r $path");
        $deleted++;
    }
});

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $deleted file(s) deleted.\n";
