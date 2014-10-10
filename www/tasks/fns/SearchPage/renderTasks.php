<?php

namespace SearchPage;

function renderTasks ($tasks, &$items, $params, $keyword, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($tasks) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once "$fnsDir/user_time_today.php";
        $time_today = user_time_today($user);

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
        $items[] = \Page\info('No tasks found');
    }

}