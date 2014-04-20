<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

unset(
    $_SESSION['tasks/edit/errors'],
    $_SESSION['tasks/edit/values'],
    $_SESSION['tasks/errors'],
    $_SESSION['tasks/messages'],
    $_SESSION['tasks/send/errors'],
    $_SESSION['tasks/send/values']
);

$base = '../../';

$items = [];

include_once '../../fns/Page/text.php';
include_once '../../fns/render_external_links.php';
$items[] = Page\text(
    nl2br(
        render_external_links(htmlspecialchars($task->text), $base)
    )
);

include_once __DIR__.'/../../fns/TaskTags/indexOnTask.php';
$tags = TaskTags\indexOnTask($mysqli, $id);
if ($tags) {
    include_once '../../fns/Page/tags.php';
    $items[] = Page\tags('../', $tags);
}

$insert_time = $task->insert_time;
$update_time = $task->update_time;
include_once '../../fns/date_ago.php';
$text =
    '<div>'.($task->top_priority ? 'Top' : 'Normal').' priority task.</div>'
    .'<div>Task created '.date_ago($insert_time).'.</div>';
if ($insert_time != $update_time) {
    $text .= '<div>Last modified '.date_ago($update_time).'.</div>';
}
include_once '../../fns/Page/infoText.php';
$items[] = Page\infoText($text);

include_once 'fns/create_options_panel.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/sessionMessages.php';
$content =
    Page\tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../home/',
            ],
            [
                'title' => 'Tasks',
                'href' => ItemList\listHref(),
            ],
        ],
        "Task #$id",
        Page\sessionMessages('tasks/view/messages')
        .join('<div class="hr"></div>', $items)
    )
    .create_options_panel($task);

include_once '../../fns/echo_page.php';
echo_page($user, "Task #$id", $content, $base);
