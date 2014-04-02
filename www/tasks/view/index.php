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

include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageLink.php';

if ($task->top_priority) {
    $href = "submit-set-normal-priority.php?id=$id";
    $priorityLink = Page\imageLink('Mark as Normal Priority', $href, 'task');
} else {
    $title = 'Mark as Top Priority';
    $href = "submit-set-top-priority.php?id=$id";
    $priorityLink = Page\imageLink($title, $href, 'task-top-priority');
}

$editLink = Page\imageArrowLink('Edit', "../edit/?id=$id", 'edit-task');

$href = "../send/?id=$id";
$sendLink = Page\imageArrowLink('Send', $href, 'send');

$href = "../delete/?id=$id";
$deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

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
    include_once '../../fns/create_tags.php';
    $items[] = create_tags('../', $tags);
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
$items[] = Page\text($text);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/twoColumns.php';
$content =
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../home/',
            ],
            [
                'title' => 'Tasks',
                'href' => '..',
            ],
        ],
        "Task #$id",
        Page\sessionMessages('tasks/view/messages')
        .join('<div class="hr"></div>', $items)
    )
    .create_panel(
        'Task Options',
        Page\twoColumns($priorityLink, $editLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($sendLink, $deleteLink)
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Task #$id", $content, $base);
