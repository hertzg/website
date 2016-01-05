<?php

function render_tasks ($tasks, &$items, $params, $user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    if ($tasks) {

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
            $href = "{$base}view/?$queryString";

            $title = htmlspecialchars($task->title);
            $items[] = create_task_link($title,
                $task->deadline_time, $task->num_tags, $task->tags_json,
                $task->top_priority, $href, $time_today, ['id' => $id], true);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No tasks');
    }

}
