<?php

function render_task ($task, &$items) {

    include_once __DIR__.'/../../../fns/Page/text.php';
    $items[] = Page\text(htmlspecialchars($task->text));

    $tags = $task->tags;
    if ($tags !== '') $items[] = Page\text('Tags: '.htmlspecialchars($tags));

}
