<?php

include_once __DIR__.'/../fns/require_user.php';
$user = require_user('../');
$id_users = $user->id_users;

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/request_strings.php';
list($year, $month, $day) = request_strings('year', 'month', 'day');

include_once '../fns/user_time_today.php';
$timeToday = user_time_today($user);

$monthToday = (int)date('n', $timeToday);
$yearToday = (int)date('Y', $timeToday);
$dayToday = (int)date('d', $timeToday);

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

include_once '../fns/Contacts/indexBirthdays.php';
$contacts = Contacts\indexBirthdays($mysqli,
    $id_users, $daySelected, $monthSelected);

include_once '../fns/Tasks/indexOnUserAndDeadline.php';
$tasks = Tasks\indexOnUserAndDeadline($mysqli, $id_users, $timeSelected);

include_once '../fns/Events/indexOnUserAndTime.php';
$events = Events\indexOnUserAndTime($mysqli, $id_users, $timeSelected);

include_once 'fns/render_events.php';
render_events($contacts, $tasks, $events, $eventItems);

if ($user->num_events) {
    include_once '../fns/Page/imageArrowLinkWithDescription.php';
    $eventItems[] = Page\imageArrowLinkWithDescription('All Events',
        "$user->num_events total.", 'all-events/', 'events',
        ['id' => 'all-events']);
}

include_once 'fns/create_content.php';
$content = create_content($mysqli, $id_users,
    $timeSelected, $monthSelected, $daySelected, $eventItems);

include_once '../fns/echo_page.php';
echo_page($user, 'Calendar', $content, '../', [
    'head' =>
        '<link rel="stylesheet" type="text/css" href="index.css?10" />'
        .'<link rel="stylesheet" type="text/css"'
        ." href=\"themes/$user->theme/index.css?2\" />"
]);
