<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'schedules/new/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'text' => '',
    ];
}

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
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Schedule')
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'New Schedule', $content, $base);
