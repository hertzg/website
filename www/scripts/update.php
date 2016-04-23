#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../lib/mysqli.php';

system('git checkout -- ../fns/ClientAddress');

include_once '../fns/Table/ensureAll.php';
echo Table\ensureAll($mysqli);

echo "Done\n";
