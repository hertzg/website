#!/usr/bin/php
<?php

include_once 'lib/defaults.php';

chdir(__DIR__);
exec('git tag | grep ^v | sort --version-sort | tail -1', $lines);
preg_match('/^v(\d+)$/', $lines[0], $match);
$next = 'v'.($match[1] + 1);
exec("git tag -a -m $next $next");
