<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['schedules/errors'],
    $_SESSION['schedules/messages'],
    $_SESSION['schedules/new/next/first_stage']
);

$key = 'schedules/new/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'text' => '',
        'day_interval' => '',
    ];
}

include_once '../../fns/time_today.php';
$timeToday = time_today();

include_once '../fns/create_interval_select.php';
include_once '../../fns/Form/button.php';
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
            'value' => $values['text'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .create_interval_select($values['day_interval'])
        .'<div class="hr"></div>'
        .Form\button('Next')
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'New Schedule', $content, $base);
