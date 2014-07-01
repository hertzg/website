<?php

function render_tasks (array $tasks, array &$items, $regex) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/time_today.php";
    $time_today = time_today();

    include_once "$fnsDir/create_task_link.php";
    foreach ($tasks as $task) {

        $title = htmlspecialchars($task->text);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
        $href = "../tasks/view/?id=$task->id_tasks";

        $items[] = create_task_link($title, $task->deadline_time,
            $task->tags, $task->top_priority, $href, $time_today);

    }

}
