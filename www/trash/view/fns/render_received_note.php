<?php

function render_received_note ($note, &$items) {

    include_once __DIR__.'/../../../fns/Page/text.php';
    $items[] = Page\text(htmlspecialchars($note->text));

    $tags = $note->tags;
    if ($tags !== '') $items[] = Page\text('Tags: '.htmlspecialchars($tags));

}
