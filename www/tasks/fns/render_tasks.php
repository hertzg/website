<?php

function render_tasks ($tasks, &$items) {
    if ($tasks) {
        foreach ($tasks as $task) {
            $icon = $task->top_priority ? 'task-top-priority' : 'task';
            $title = htmlspecialchars($task->tasktext);
            $href = "view/?id=$task->idtasks";
            $tags = $task->tags;
            if ($tags) {
                $description = 'Tags: '.htmlspecialchars($tags);
                $items[] = Page::imageArrowLinkWithDescription($title,
                    $description, $href, $icon);
            } else {
                $items[] = Page::imageArrowLink($title, $href, $icon);
            }
        }
    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info('No tasks.');
    }
}
