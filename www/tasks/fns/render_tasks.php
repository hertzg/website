<?php

function render_tasks (array $tasks, array &$items, array $params) {

    if ($tasks) {

        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';

        foreach ($tasks as $task) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $task->id_tasks], $params)
                )
            );
            $href = "view/?$queryString";

            $icon = $task->top_priority ? 'task-top-priority' : 'task';
            $title = htmlspecialchars($task->text);
            $tags = $task->tags;
            if ($tags) {
                $description = 'Tags: '.htmlspecialchars($tags);
                $items[] = Page\imageArrowLinkWithDescription($title,
                    $description, $href, $icon);
            } else {
                $items[] = Page\imageArrowLink($title, $href, $icon);
            }

        }

    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info('No tasks');
    }

}
