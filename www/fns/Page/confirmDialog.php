<?php

namespace Page;

function confirmDialog ($questionText, $yesText, $yesHref, $noHref) {
    include_once __DIR__.'/imageLink.php';
    include_once __DIR__.'/text.php';
    include_once __DIR__.'/twoColumns.php';
    return
        '<div class="confirmDialog">'
            .'<div class="confirmDialog-aligner"></div>'
            .'<div class="confirmDialog-frame">'
                .text($questionText)
                .'<div class="hr"></div>'
                .twoColumns(
                    imageLink($yesText, $yesHref, 'yes'),
                    imageLink('No, return back', $noHref, 'no')
                )
            .'</div>'
        .'</div>';
}
