<?php

function render_tasks (array $tasks, array &$items) {
    foreach ($tasks as $task) {
        $icon = $task->top_priority ? 'task-top-priority' : 'task';
        $title = htmlspecialchars($task->tasktext);
        $href = "../tasks/view/?id=$task->idtasks";
        $tags = $task->tags;
        if ($tags) {
            $description = 'Tags: '.htmlspecialchars($tags);
            $items[] = Page::imageArrowLinkWithDescription($title,
                $description, $href, $icon);
        } else {
            $items[] = Page::imageArrowLink($title, $href, $icon);
        }
    }
}
