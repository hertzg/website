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

    include_once '../../fns/Schedules/request.php';
    list($text, $interval, $tags, $offset) = Schedules\request();

    $values = [
        'text' => $text,
        'interval' => $interval,
        'tags' => $tags,
    ];

}

include_once '../../fns/Schedules/maxLengths.php';
$maxLengths = Schedules\maxLengths();

include_once '../fns/create_interval_select.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/ItemList/pageHiddenInputs.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Schedules',
            'href' => ItemList\listHref(),
        ],
    ],
    'New Schedule',
    Page\sessionErrors('schedules/new/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('text', 'Text', [
            'value' => $values['text'],
            'maxlength' => $maxLengths['text'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .create_interval_select($values['interval'])
        .'<div class="hr"></div>'
        .Form\textfield('tags', 'Tags', [
            'value' => $values['tags'],
            'maxlength' => $maxLengths['tags'],
        ])
        .'<div class="hr"></div>'
        .Form\button('Next')
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once '../../fns/echo_user_page.php';
echo_user_page($user, 'New Schedule', $content, $base);
