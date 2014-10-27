<?php

function render_tasks ($tasks, &$items, $regex, $encodedKeyword, $user) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/user_time_today.php";
    $time_today = user_time_today($user);

    include_once "$fnsDir/create_task_link.php";
    foreach ($tasks as $task) {

        $title = htmlspecialchars($task->text);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
        $query = "?id=$task->id&amp;keyword=$encodedKeyword";
        $href = "../tasks/view/$query";

        $items[] = create_task_link($title, $task->deadline_time,
            $task->tags, $task->top_priority, $href, $time_today);

    }

}
