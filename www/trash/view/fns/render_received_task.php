<?php

function render_received_task ($task, &$items, &$infoText) {

    include_once __DIR__.'/../../../fns/Page/text.php';
    $items[] = Page\text(htmlspecialchars($task->text));

    $tags = $task->tags;
    if ($tags !== '') $items[] = Page\text('Tags: '.htmlspecialchars($tags));

    $priority = $task->top_priority ? 'Top' : 'Normal';
    $infoText = "$priority priotity task.</br>$infoText";

}
