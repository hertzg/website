<?php

function render_trash ($user, &$items) {

    if (!$user->show_trash) return;

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    $items['trash'] = Page\imageArrowLink('Trash', '../trash/', 'trash-bin');

}
