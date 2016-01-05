<?php

function render_tasks ($tasks, $total,
    $groupLimit, &$items, $regex, $encodedKeyword, $user) {

    $fnsDir = __DIR__.'/../../fns';

    $num_tasks = count($tasks);
    if ($total > $groupLimit) array_pop($tasks);

    include_once "$fnsDir/user_time_today.php";
    $time_today = user_time_today($user);

    include_once "$fnsDir/create_task_link.php";
    foreach ($tasks as $task) {

        $title = htmlspecialchars($task->text);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);

        $items[] = create_task_link($title, $task->deadline_time,
            $task->num_tags, $task->tags_json, $task->top_priority,
            "../tasks/view/?id=$task->id&amp;keyword=$encodedKeyword",
            $time_today);

    }

    if ($num_tasks < $total) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items[] = Page\imageArrowLink("Show All $total Tasks",
            "../tasks/search/?keyword=$encodedKeyword", 'tasks');
    }

}
