<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'calendar/add-event/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {

    include_once '../../fns/request_strings.php';
    list($year, $month, $day) = request_strings('year', 'month', 'day');

    $values = [
        'event_day' => abs((int)$day),
        'event_month' => abs((int)$month),
        'event_year' => abs((int)$year),
        'event_text' => '',
    ];

}

unset(
    $_SESSION['calendar/errors'],
    $_SESSION['calendar/messages']
);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/datefield.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Calendar',
            'href' => '..',
        ],
    ],
    'New Event',
    Page\sessionErrors('calendar/add-event/errors')
    .'<form action="submit.php" method="post">'
        .Form\datefield([
            'name' => 'event_day',
            'value' => $values['event_day'],
        ],
        [
            'name' => 'event_month',
            'value' => $values['event_month'],
        ],
        [
            'name' => 'event_year',
            'value' => $values['event_year'],
        ], 'When', true)
        .'<div class="hr"></div>'
        .Form\textfield('event_text', 'Text', [
            'value' => $values['event_text'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Event')
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'New Event', $content, $base);
