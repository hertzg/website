<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

$key = 'calendar/all-events/new/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {

    include_once "$fnsDir/request_strings.php";
    list($year, $month, $day) = request_strings('year', 'month', 'day');

    $day = abs((int)$day);
    $month = abs((int)$month);
    $year = abs((int)$year);

    if ($year === 0) $year = (int)date('Y');
    if ($month === 0) $month = (int)date('n');
    if ($day === 0) $day = (int)date('j');

    $values = [
        'event_day' => $day,
        'event_month' => $month,
        'event_year' => $year,
        'text' => '',
    ];

}

$event_day = $values['event_day'];
$event_month = $values['event_month'];
$event_year = $values['event_year'];

unset(
    $_SESSION['calendar/errors'],
    $_SESSION['calendar/messages']
);

include_once "$fnsDir/Events/maxLengths.php";
$maxLengths = Events\maxLengths();

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/datefield.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'All Events',
            'href' => '..',
        ],
    ],
    'New Event',
    Page\sessionErrors('calendar/all-events/new/errors')
    .'<form action="submit.php" method="post">'
        .Form\datefield([
            'name' => 'event_day',
            'value' => $event_day,
        ],
        [
            'name' => 'event_month',
            'value' => $event_month,
        ],
        [
            'name' => 'event_year',
            'value' => $event_year,
        ], 'When', true)
        .'<div class="hr"></div>'
        .Form\textfield('text', 'Text', [
            'value' => $values['text'],
            'maxlength' => $maxLengths['text'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Event')
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'New Event', $content, $base);
