<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

unset(
    $_SESSION['tasks/edit/index_errors'],
    $_SESSION['tasks/edit/index_values'],
    $_SESSION['tasks/index_errors'],
    $_SESSION['tasks/index_messages']
);

include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageLink.php';

$options = array();
if ($task->top_priority) {
    $href = "submit-set-normal-priority.php?id=$id";
    $options[] = Page\imageLink('Mark as Normal Priority', $href, 'task');
} else {
    $title = 'Mark as Top Priority';
    $href = "submit-set-top-priority.php?id=$id";
    $options[] = Page\imageLink($title, $href, 'task-top-priority');
}
$options[] = Page\imageArrowLink('Edit Task', "../edit/?id=$id", 'edit-task');

$href = "../delete/?id=$id";
$options[] = Page\imageArrowLink('Delete Task', $href, 'trash-bin');

$base = '../../';

$items = array();

include_once '../../fns/Page/text.php';
include_once '../../fns/render_external_links.php';
$items[] = Page\text(
    nl2br(
        render_external_links(htmlspecialchars($task->tasktext), $base)
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
$text = '<div>Task created '.date_ago($insert_time).'.</div>';
if ($insert_time != $update_time) {
    $text .= '<div>Last modified '.date_ago($update_time).'.</div>';
}
$items[] = Page\text($text);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../../home/',
            ),
            array(
                'title' => 'Tasks',
                'href' => '..',
            ),
        ),
        "Task #$id",
        Page\sessionMessages('tasks/view/index_messages')
        .join('<div class="hr"></div>', $items)
    )
    .create_panel('Options', join('<div class="hr"></div>', $options));

include_once '../../fns/echo_page.php';
echo_page($user, "Task #$id", $content, $base);
