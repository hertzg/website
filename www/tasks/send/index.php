<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

unset($_SESSION['tasks/view/messages']);

$key = 'tasks/send/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['username' => ''];

include_once '../../fns/ItemList/escapedItemQuery.php';
include_once '../../fns/ItemList/itemParams.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/Page/itemSendForm.php';
include_once '../../fns/Page/tabs.php';
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
    .Page\itemSendForm($mysqli, $user->id_users,
        $values['username'], ItemList\itemParams($id))
);

include_once '../../fns/echo_page.php';
echo_page($user, "Send Task #$id", $content, '../../');
