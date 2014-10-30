<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'tasks/new/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'text' => '',
        'deadline_day' => 0,
        'deadline_month' => 0,
        'deadline_year' => 0,
        'tags' => '',
        'top_priority' => false,
    ];
}

unset(
    $_SESSION['home/messages'],
    $_SESSION['tasks/errors'],
    $_SESSION['tasks/messages']
);

include_once '../fns/create_form_items.php';
include_once '../../fns/compressed_js_script.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/ItemList/pageHiddenInputs.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/staticTwoColumns.php';
include_once '../../fns/Page/tabs.php';
$content =
    Page\tabs(
        [
            [
                'title' => 'Tasks',
                'href' => ItemList\listHref(),
            ],
        ],
        'New',
        Page\sessionErrors('tasks/new/errors')
        .'<form action="submit.php" method="post">'
            .create_form_items($values)
            .'<div class="hr"></div>'
            .Page\staticTwoColumns(
                Form\button('Save'),
                Form\button('Send', 'sendButton')
            )
            .ItemList\pageHiddenInputs()
        .'</form>'
    )
    .compressed_js_script('formCheckbox', $base);

include_once '../../fns/echo_page.php';
echo_page($user, 'New Task', $content, $base);
