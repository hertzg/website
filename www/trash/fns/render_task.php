<?php

function render_task ($task, &$title, &$icon) {

    $title = htmlspecialchars($task->title);

    if ($task->top_priority) $icon = 'task-top-priority';
    else $icon = 'task';

}
