<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');

include_once "$fnsDir/user_time_today.php";
$yearToday = date('Y', user_time_today($user));

$maxYear = $yearToday + 100;
$minYear = $yearToday - 100;

include_once "$fnsDir/Date/request.php";
list($day, $month, $year) = Date\request();

$year = max(1900, min($maxYear, (int)$year));

include_once "$fnsDir/redirect.php";

include_once "$fnsDir/Date/isValid.php";
if (!Date\isValid($day, $month, $year)) {
    $_SESSION['calendar/jump-to/errors'] = ['The date is invalid'];
    redirect("./?year=$year&month=$month&day=$day");
}

unset($_SESSION['calendar/jump-to/errors']);

redirect("../?year=$year&month=$month&day=$day");
