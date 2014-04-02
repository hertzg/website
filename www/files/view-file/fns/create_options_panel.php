<?php

function create_options_panel ($file) {

    include_once __DIR__.'/../../../fns/Page/imageArrowLink.php';
    include_once __DIR__.'/../../../fns/Page/imageLink.php';

    $id = $file->id_files;

    $options = [];

    $href = "../download-file/?id=$id";
    $options[] = Page\imageLink('Download', $href, 'download');

    $href = "../rename-file/?id=$id";
    $options[] = Page\imageArrowLink('Rename', $href, 'rename');

    $href = "../move-file/?id=$id&id_folders=$file->id_folders";
    $options[] = Page\imageArrowLink('Move', $href, 'move-file');

    $href = "../delete-file/?id=$id";
    $options[] = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once __DIR__.'/../../../fns/create_panel.php';
    return create_panel('File Options', join('<div class="hr"></div>', $options));

}
