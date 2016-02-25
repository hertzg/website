#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/cli.php';
include_once '../../../lib/defaults.php';

include_once '../../fns/ClientAddress/GetMethod/setBehindProxy.php';
\ClientAddress\GetMethod\setBehindProxy();

echo "Done.\n";
