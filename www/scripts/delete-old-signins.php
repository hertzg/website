#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$time = time();
include_once '../fns/auth_expire_days.php';
$insert_time = $time - auth_expire_days() * 24 * 60 * 60;

include_once '../fns/Signins/deleteOlder.php';
Signins\deleteOlder($mysqli, $insert_time);

include_once '../fns/InvalidSignins/deleteOlder.php';
InvalidSignins\deleteOlder($mysqli, $insert_time);

include_once '../fns/AdminApiKeyAuths/deleteOlder.php';
AdminApiKeyAuths\deleteOlder($mysqli, $insert_time);

include_once '../fns/AdminConnectionAuths/deleteOlder.php';
AdminConnectionAuths\deleteOlder($mysqli, $insert_time);

include_once '../fns/CrossSiteApiKeys/deleteOlder.php';
CrossSiteApiKeys\deleteOlder($mysqli, $time - 30 * 60);

include_once '../fns/ApiKeyAuths/deleteOlder.php';
ApiKeyAuths\deleteOlder($mysqli, $insert_time);

include_once '../fns/TokenAuths/deleteOlder.php';
TokenAuths\deleteOlder($mysqli, $insert_time);

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
