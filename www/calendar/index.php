<?php

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
$dayToday = (int)date('j', $timeToday);

if ($year === '') $year = $yearToday;
else $year = (int)$year;

if ($month === '') $month = $monthToday;
else $month = (int)$month;

if ($day === '') $day = $dayToday;
else $day = (int)$day;

$timeSelected = mktime(0, 0, 0, $month, $day, $year);
$monthSelected = date('n', $timeSelected);
$daySelected = date('j', $timeSelected);

include_once '../lib/mysqli.php';

include_once "$fnsDir/Contacts/indexBirthdays.php";
$contacts = Contacts\indexBirthdays($mysqli,
    $id_users, $daySelected, $monthSelected);

include_once "$fnsDir/Tasks/indexOnUserAndDeadline.php";
$tasks = Tasks\indexOnUserAndDeadline($mysqli, $id_users, $timeSelected);

include_once "$fnsDir/Events/indexOnUserAndTime.php";
$events = Events\indexOnUserAndTime($mysqli, $id_users, $timeSelected);

include_once 'fns/render_events.php';
render_events($contacts, $tasks, $events, $eventItems);

if ($user->num_events) {
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    $eventItems[] = Page\imageArrowLinkWithDescription('All Events',
        "$user->num_events total.", 'all-events/', 'events',
        ['id' => 'all-events']);
}

include_once 'fns/create_content.php';
$content = create_content($mysqli, $user,
    $timeSelected, $monthSelected, $daySelected, $eventItems);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Calendar', $content, $base, [
    'head' =>
        '<link rel="stylesheet" type="text/css" href="index.css?11" />'
        .'<link rel="stylesheet" type="text/css"'
        ." href=\"theme/color/$user->theme_color/index.css?3\" />"
        .compressed_css_link('calendarIcon', $base),
    'scripts' => compressed_js_script('calendarIcon', $base),
]);
