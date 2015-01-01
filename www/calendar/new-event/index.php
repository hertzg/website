<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'calendar/new-event/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {

    include_once '../../fns/request_strings.php';
    list($year, $month, $day) = request_strings('year', 'month', 'day');

    $values = [
        'event_day' => abs((int)$day),
        'event_month' => abs((int)$month),
        'event_year' => abs((int)$year),
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

include_once '../../fns/Events/maxLengths.php';
$maxLengths = Events\maxLengths();

include_once '../fns/calendar_href.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/datefield.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Calendar',
            'href' => calendar_href($event_day, $event_month, $event_year).'#new-event',
        ],
    ],
    'New Event',
    Page\sessionErrors('calendar/new-event/errors')
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

include_once '../../fns/echo_page.php';
echo_page($user, 'New Event', $content, $base);
