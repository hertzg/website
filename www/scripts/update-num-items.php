#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

include_once '../fns/Users/updateNumbers.php';
Users\updateNumbers($mysqli);

include_once '../fns/Channels/updateNumbers.php';
Channels\updateNumbers($mysqli);

include_once '../fns/SubscribedChannels/updateNumbers.php';
SubscribedChannels\updateNumbers($mysqli);

include_once '../fns/BarCharts/updateNumbers.php';
BarCharts\updateNumbers($mysqli);

include_once '../fns/Wallets/updateNumbers.php';
Wallets\updateNumbers($mysqli);

include_once '../fns/Places/updateNumbers.php';
Places\updateNumbers($mysqli);

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
