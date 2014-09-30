<?php

namespace ViewPage;

function renderTask ($task, $user, &$items, &$infoText) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/text.php";
    $items[] = \Page\text(htmlspecialchars($task->text));

    $deadline_time = $task->deadline_time;
    if ($deadline_time !== null) {

        include_once "$fnsDir/user_time_today.php";
        $time_today = user_time_today($user);

        include_once "$fnsDir/format_deadline.php";
        $items[] = \Page\text('Deadline '.date('F d, Y', $deadline_time)
            .' ('.format_deadline($deadline_time, $time_today).')');

    }

    $tags = $task->tags;
    if ($tags !== '') $items[] = \Page\text('Tags: '.htmlspecialchars($tags));

    $priority = $task->top_priority ? 'Top' : 'Normal';
    $infoText = "$priority priotity task.</br>$infoText";

}
