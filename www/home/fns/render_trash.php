<?php

function render_trash ($user, &$items) {
    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    $items['trash'] = Page\imageArrowLink('Trash', '../trash/', 'trash-bin');
}
