<?php

function render_tasks (array $tasks, array &$items, array $params, $keyword) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($tasks) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once "$fnsDir/time_today.php";
        $time_today = time_today();

        include_once "$fnsDir/create_task_link.php";
        foreach ($tasks as $task) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $task->id_tasks], $params)
                )
            );
            $href = "../view/?$queryString";

            $title = htmlspecialchars($task->text);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);

            $items[] = create_task_link($title, $task->deadline_time,
                $task->tags, $task->top_priority, $href, $time_today);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No tasks found');
    }

}
