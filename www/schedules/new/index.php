<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'schedules/new/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'name' => '',
    ];
}

include_once '../../fns/Form/button.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../home/',
        ],
    ],
    'Schedules',
    '<form method="post">'
        .Form\textfield('name', 'Name', [
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Schedule')
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Schedules', $content, $base);
