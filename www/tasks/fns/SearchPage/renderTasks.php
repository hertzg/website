<?php

namespace SearchPage;

function renderTasks ($tasks, &$items, $params, $includes, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($tasks) {

        include_once "$fnsDir/keyword_regex.php";
        $regex = keyword_regex($includes);

        include_once "$fnsDir/user_time_today.php";
        $time_today = user_time_today($user);

        include_once "$fnsDir/create_task_link.php";
        foreach ($tasks as $task) {

            $id = $task->id;
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "../view/?$queryString";

            $title = htmlspecialchars($task->text);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);

            $items[] = create_task_link($title,
                $task->deadline_time, $task->num_tags, $task->tags_json,
                $task->top_priority, $href, $time_today, ['id' => $id]);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No tasks found');
    }

}
