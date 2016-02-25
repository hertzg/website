#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/cli.php';
include_once '../../../lib/defaults.php';
include_once '../../lib/mysqli.php';

include_once '../../fns/ReceivedTasks/ensure.php';
echo ReceivedTasks\ensure($mysqli);
