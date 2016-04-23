#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';

if (count($argv) !== 2) {
    echo "Usage:\n"
        ." ./set-reverse-proxies.php <number>\n";
    exit;
}

include_once '../fns/NumReverseProxies/set.php';
NumReverseProxies\set(abs((int)$argv[1]));
