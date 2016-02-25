<?php

include_once '../../lib/defaults.php';

$base = '../';
$fnsDir = '../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);
$id_users = $user->id_users;

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/request_strings.php";
list($year, $month, $day) = request_strings('year', 'month', 'day');

include_once "$fnsDir/user_time_today.php";
$timeToday = user_time_today($user);

$yearToday = (int)date('Y', $timeToday);
$monthToday = (int)date('n', $timeToday);

$year_empty = $year === '';
$month_empty = $month === '';

if ($year_empty) $year = $yearToday;
else $year = (int)$year;

if ($month_empty) $month = $monthToday;
else $month = (int)$month;

if ($day === '') {
    if ($month_empty && $year_empty) $day = (int)date('j', $timeToday);
    else $day = null;
} else {
    $day = (int)$day;
}

include_once 'fns/events_panel.php';
include_once '../lib/mysqli.php';
$events_panel = events_panel($mysqli, $user, $day, $month, $year, $timeToday);

include_once 'fns/create_content.php';
$content = create_content($mysqli, $user,
    $timeToday, $year, $month, $day, $events_panel);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Calendar', $content, $base, [
    'head' =>
        '<link rel="stylesheet" type="text/css" href="index.css?15" />'
        .compressed_css_link('calendarIcon', $base),
    'scripts' => compressed_js_script('calendarIcon', $base),
]);
