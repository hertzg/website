<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id) = require_task($mysqli);

unset($_SESSION['tasks/view/index_messages']);

include_once '../../fns/Page/text.php';
$question = Page\text('Are you sure you want to delete the task?');

include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
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
        $question.'<div class="hr"></div>'
        .Page\imageLink('Yes, delete task', "submit.php?id=$id", 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', "../view/?id=$id", 'no')
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Delete Task #$id?", $content, '../../');
