<?php

function render_tasks (array $tasks, array &$items, array $params, $keyword) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($tasks) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once "$fnsDir/time_today.php";
        $time_today = time_today();

        include_once "$fnsDir/Page/imageArrowLink.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";

        foreach ($tasks as $task) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $task->id_tasks], $params)
                )
            );
            $href = "../view/?$queryString";

            $icon = $task->top_priority ? 'task-top-priority' : 'task';
            $title = htmlspecialchars($task->text);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);

            $tags = $task->tags;
            $deadline_time = $task->deadline_time;

            $descriptions = [];
            if ($deadline_time !== null) {
                include_once "$fnsDir/format_deadline.php";
                $descriptions[] = 'Deadline '.format_deadline($deadline_time, $time_today);
            }
            if ($tags !== '') {
                $descriptions[] = 'Tags: '.htmlspecialchars($tags);
            }

            if ($descriptions) {
                $description = join(' &middot ', $descriptions);
                $items[] = Page\imageArrowLinkWithDescription(
                    $title, $description, $href, $icon);
            } else {
                $items[] = Page\imageArrowLink($title, $href, $icon);
            }

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No tasks found');
    }

}
