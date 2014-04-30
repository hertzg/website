<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['schedules/errors'],
    $_SESSION['schedules/messages']
);

$key = 'schedules/new/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'text' => '',
        'time_interval' => '',
        'time_offset' => '',
    ];
}

include_once '../../fns/Form/button.php';
include_once '../../fns/Form/select.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Schedules',
            'href' => '..',
        ],
    ],
    'New',
    Page\sessionErrors('schedules/new/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('text', 'Text', [
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\select('time_interval', 'Repeat in every', [
            '2' => '2 days',
            '3' => '3 days',
            '4' => '4 days',
            '5' => '5 days',
            '6' => '6 days',
            '7' => '7 days',
            '8' => '8 days',
            '9' => '9 days',
            '10' => '10 days',
            '11' => '11 days',
            '12' => '12 days',
            '13' => '13 days',
            '14' => '14 days',
            '15' => '15 days',
        ], $values['time_interval'])
        .'<div class="hr"></div>'
        .Form\select('time_offset', 'Start from', [
            '0' => 'Today',
            '1' => 'Tomorrow',
        ], $values['time_offset'])
        .Form\button('Save Schedule')
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'New Schedule', $content, $base);
