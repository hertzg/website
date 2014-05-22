<?php

function render_tasks (array $tasks, array &$items, array $params) {

    $fnsPageDir = __DIR__.'/../../fns/Page';

    if ($tasks) {

        include_once "$fnsPageDir/imageArrowLink.php";
        include_once "$fnsPageDir/imageArrowLinkWithDescription.php";

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
        include_once "$fnsPageDir/info.php";
        $items[] = Page\info('No tasks');
    }

}
