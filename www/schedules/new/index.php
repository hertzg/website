<?php

include_once '../../../lib/defaults.php';

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['schedules/errors'],
    $_SESSION['schedules/messages'],
    $_SESSION['schedules/new/next/first_stage'],
    $_SESSION['schedules/view/messages']
);

$key = 'schedules/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    include_once '../../fns/Schedules/request.php';
    list($text, $interval, $offset, $tags) = Schedules\request();

    $values = [
        'focus' => 'text',
        'text' => $text,
        'interval' => $interval,
        'tags' => $tags,
    ];

}

include_once '../fns/create_first_stage_form_items.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/ItemList/pageHiddenInputs.php';
include_once '../../fns/Page/create.php';
include_once '../../fns/Page/sessionErrors.php';
$content = Page\create(
    [
        'title' => 'Schedules',
        'href' => ItemList\listHref(),
    ],
    'New Schedule',
    Page\sessionErrors('schedules/new/errors')
    .'<form action="submit.php" method="post">'
        .create_first_stage_form_items($values)
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once '../../fns/echo_user_page.php';
echo_user_page($user, 'New Schedule', $content, $base);
