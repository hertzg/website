<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($month, $year) = request_strings('month', 'year');

$timeNow = time();
$maxYear = date('Y', $timeNow) + 100;

$year = max(1900, min($maxYear, (int)$year));
$month = max(1, min(12, (int)$month));

include_once '../../fns/redirect.php';
redirect("../?year=$year&month=$month");
