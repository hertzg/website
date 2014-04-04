<?php

function render_tasks (array $tasks, array &$items) {
    if ($tasks) {

        include_once __DIR__.'/../../../fns/Page/imageArrowLink.php';
        include_once __DIR__.'/../../../fns/Page/imageArrowLinkWithDescription.php';

        foreach ($tasks as $task) {
            $icon = $task->top_priority ? 'task-top-priority' : 'task';
            $title = htmlspecialchars($task->text);
            $href = "../view/?id=$task->id_tasks";
            $tags = $task->tags;
            if ($tags === '') {
                $items[] = Page\imageArrowLink($title, $href, $icon);
            } else {
                $description = 'Tags: '.htmlspecialchars($tags);
                $items[] = Page\imageArrowLinkWithDescription($title,
                    $description, $href, $icon);
            }
        }

    } else {
        include_once __DIR__.'/../../../fns/Page/info.php';
        $items[] = Page\info('No tasks found');
    }
}
