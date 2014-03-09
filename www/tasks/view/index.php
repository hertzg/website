<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id) = require_task($mysqli);

include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageLink.php';

unset(
    $_SESSION['tasks/edit_errors'],
    $_SESSION['tasks/edit_lastpost'],
    $_SESSION['tasks/index_messages']
);

$options = array();
if ($task->top_priority) {
    $options[] = Page\imageLink('Mark as Normal Priority',
        "submit-set-normal-priority.php?id=$id", 'task');
} else {
    $options[] = Page\imageLink('Mark as Top Priority',
        "submit-set-top-priority.php?id=$id", 'task-top-priority');
}
$options[] = Page\imageArrowLink('Edit Task', "../edit/?id=$id", 'edit-task');
$options[] = Page\imageArrowLink('Delete Task', "../delete/?id=$id", 'trash-bin');

$tasktext = $task->tasktext;
$inserttime = $task->inserttime;
$updatetime = $task->updatetime;

include_once __DIR__.'/../../fns/TaskTags/indexOnTask.php';
$tags = TaskTags\indexOnTask($mysqli, $id);

$base = '../../';

include_once '../../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('tasks/view/index_messages');

include_once '../../fns/date_ago.php';
include_once '../../fns/Page/text.php';
$datesText = '<div>Task created '.date_ago($inserttime).'.</div>';
if ($inserttime != $updatetime) {
    $datesText .= '<div>Last modified '.date_ago($updatetime).'.</div>';
}
$datesText = Page\text($datesText);

include_once '../../fns/render_external_links.php';
$text = Page\text(
    nl2br(
        render_external_links(htmlspecialchars($tasktext), $base)
    )
);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/create_tags.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Tasks',
                'href' => '..',
            ),
        ),
        "Task #$id",
        $pageMessages.$text.create_tags('../', $tags).'<div class="hr"></div>'.$datesText
    )
    .create_panel('Options', join('<div class="hr"></div>', $options));

include_once '../../fns/echo_page.php';
echo_page($user, "Task #$id", $content, $base);
