<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/Date/request.php';
list($day, $month, $year) = Date\request();

$timeNow = time();
$maxYear = date('Y', $timeNow) + 100;
$year = max(1900, min($maxYear, (int)$year));

include_once '../../fns/redirect.php';

include_once '../../fns/date_is_valid.php';
if (!date_is_valid($day, $month, $year)) {
    $_SESSION['calendar/jump-to/errors'] = ['The date is invalid'];
    redirect("./?year=$year&month=$month&day=$day");
}

unset($_SESSION['calendar/jump-to/errors']);

redirect("../?year=$year&month=$month&day=$day");
