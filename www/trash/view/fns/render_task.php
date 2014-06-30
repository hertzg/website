<?php

function render_task ($task, &$items, &$infoText) {

    include_once __DIR__.'/../../../fns/Page/text.php';
    $items[] = Page\text(htmlspecialchars($task->text));

    $deadline_time = $task->deadline_time;
    if ($deadline_time !== null) {
        $items[] = Page\text('Deadline '.date('F d, Y', $deadline_time));
    }

    $tags = $task->tags;
    if ($tags !== '') $items[] = Page\text('Tags: '.htmlspecialchars($tags));

    $priority = $task->top_priority ? 'Top' : 'Normal';
    $infoText = "$priority priotity task.</br>$infoText";

}
