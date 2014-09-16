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
    $_SESSION['tasks/send/messages'],
    $_SESSION['tasks/send/values']
);

$base = '../../';

include_once '../../fns/create_text_item.php';
$items = [create_text_item($task->text, $base)];

$deadline_time = $task->deadline_time;
if ($deadline_time !== null) {
    include_once '../../fns/time_today.php';
    include_once '../../fns/format_deadline.php';
    $items[] = Page\text('Deadline '.date('F d, Y', $deadline_time)
        .' ('.format_deadline($deadline_time, time_today()).')');
}

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
$infoText = Page\infoText($text);

include_once 'fns/create_options_panel.php';
include_once '../../fns/create_new_item_button.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/tabs.php';
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
        .$infoText,
        create_new_item_button('Task', '../')
    )
    .create_options_panel($task);

include_once '../../fns/echo_page.php';
echo_page($user, "Task #$id", $content, $base);
