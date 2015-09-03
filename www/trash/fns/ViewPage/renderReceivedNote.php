<?php

namespace ViewPage;

function renderReceivedNote ($note, &$items, &$infoText) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/text.php";
    $items[] = \Page\text(nl2br(htmlspecialchars($note->text)));

    $tags = $note->tags;
    if ($tags !== '') $items[] = \Page\text('Tags: '.htmlspecialchars($tags));

    if ($note->encrypt_in_listings) {
        $infoText = "Encrypted in listings.<br />.$infoText";
    }

}
