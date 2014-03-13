<?php

function create_options_panel ($file) {

    $id = $file->idfiles;

    $options = array();

    $href = "../download-file/?id=$id";
    $options[] = Page\imageLink('Download File', $href, 'download');

    $href = "../rename-file/?id=$id";
    $options[] = Page\imageArrowLink('Rename File', $href, 'rename');

    $href = "../move-file/?id=$id&idfolders=$file->idfolders";
    $options[] = Page\imageArrowLink('Move File', $href, 'move-file');

    $href = "../delete-file/?id=$id";
    $options[] = Page\imageArrowLink('Delete File', $href, 'trash-bin');

    include_once __DIR__.'/../../../fns/create_panel.php';
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
