<?php

function render_task ($task, $description, $href, &$items) {

    $title = htmlspecialchars($task->text);

    if ($task->top_priority) $icon = 'task-top-priority';
    else $icon = 'task';

    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, $icon);

}
