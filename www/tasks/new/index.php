<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

$key = 'tasks/new/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {

    include_once '../../fns/Tasks/request.php';
    list($text, $top_priority) = Tasks\request();

    $values = [
        'text' => $text,
        'deadline_day' => 0,
        'deadline_month' => 0,
        'deadline_year' => 0,
        'tags' => '',
        'top_priority' => $top_priority,
    ];

}

unset(
    $_SESSION['home/messages'],
    $_SESSION['tasks/errors'],
    $_SESSION['tasks/messages']
);

include_once '../fns/create_form_items.php';
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/ItemList/pageHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/staticTwoColumns.php";
include_once "$fnsDir/Page/tabs.php";
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
            .create_form_items($user, $values)
            .'<div class="hr"></div>'
            .Page\staticTwoColumns(
                Form\button('Save'),
                Form\button('Send', 'sendButton')
            )
            .ItemList\pageHiddenInputs()
        .'</form>'
    )
    .compressed_js_script('flexTextarea', $base)
    .compressed_js_script('formCheckbox', $base);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'New Task', $content, $base);
