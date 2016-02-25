#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/cli.php';
include_once '../../../lib/defaults.php';

include_once '../../fns/ClientAddress/GetMethod/setDirect.php';
\ClientAddress\GetMethod\setDirect();

echo "Done.\n";
