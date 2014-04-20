<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

unset($_SESSION['tasks/view/messages']);

$key = 'tasks/send/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = ['username' => ''];
}

include_once '../../fns/ItemList/escapedItemQuery.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/ItemList/itemHiddenInputs.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/warnings.php';
include_once '../../fns/Username/maxLength.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => ItemList\listHref(),
        ],
        [
            'title' => "Task #$id",
            'href' => '../view/'.ItemList\escapedItemQuery($id),
        ],
    ],
    'Send',
    Page\sessionErrors('tasks/send/errors')
    .Page\warnings(['Send the task to:'])
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'Zvini username', [
            'value' => $values['username'],
            'maxlength' => Username\maxLength(),
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Send')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, "Send Task #$id", $content, '../../');
