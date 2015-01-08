<?php

function render_task ($task, $description, $href, $options, &$items) {

    $title = htmlspecialchars($task->title);

    if ($task->top_priority) $icon = 'task-top-priority';
    else $icon = 'task';

    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, $icon, $options);

}
