<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');

include_once "$fnsDir/Date/request.php";
list($day, $month, $year) = Date\request();

include_once "$fnsDir/user_time_today.php";
$maxYear = date('Y', user_time_today($user)) + 100;
$year = max(1900, min($maxYear, (int)$year));

include_once "$fnsDir/redirect.php";

include_once "$fnsDir/Date/isValid.php";
if (!Date\isValid($day, $month, $year)) {
    $_SESSION['calendar/jump-to/errors'] = ['The date is invalid'];
    redirect("./?year=$year&month=$month&day=$day");
}

unset($_SESSION['calendar/jump-to/errors']);

redirect("../?year=$year&month=$month&day=$day");
