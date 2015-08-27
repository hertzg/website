<?php

namespace ViewPage;

function renderNote ($note, &$items, &$infoText) {

    include_once __DIR__.'/../../../fns/Page/text.php';
    $items[] = \Page\text(nl2br(htmlspecialchars($note->text)));

    $tags = $note->tags;
    if ($tags !== '') $items[] = \Page\text('Tags: '.htmlspecialchars($tags));

    if ($note->encrypt_in_listings) {
        $infoText = "Encrypted in listings.<br />.$infoText";
    }

}
