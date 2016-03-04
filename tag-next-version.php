#!/usr/bin/php
<?php

chdir(__DIR__);
include_once 'lib/cli.php';
include_once 'lib/defaults.php';

exec('git tag | grep ^v | sort --version-sort | tail -1', $lines);
preg_match('/^v(\d+)$/', $lines[0], $match);
$next = 'v'.($match[1] + 1);
exec("git tag -a -m $next $next");
