<?php

include_once 'lib/require-user.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';

list($month, $year) = request_strings('month', 'year');

$timeNow = time();
$maxYear = date('Y', $timeNow) + 100;

$year = max(1900, min($maxYear, (int)$year));
$month = max(1, min(12, (int)$month));

redirect("index.php?year=$year&month=$month");
