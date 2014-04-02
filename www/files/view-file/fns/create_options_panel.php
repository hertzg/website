<?php

function create_options_panel ($file) {

    include_once __DIR__.'/../../../fns/Page/imageArrowLink.php';
    include_once __DIR__.'/../../../fns/Page/imageLink.php';

    $id = $file->id_files;

    $href = "../download-file/?id=$id";
    $downloadLink = Page\imageLink('Download', $href, 'download');

    $href = "../rename-file/?id=$id";
    $renameLink = Page\imageArrowLink('Rename', $href, 'rename');

    $href = "../move-file/?id=$id&id_folders=$file->id_folders";
    $moveLink = Page\imageArrowLink('Move', $href, 'move-file');

    $href = "../delete-file/?id=$id";
    $deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once __DIR__.'/../../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns($downloadLink, $renameLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($moveLink, $deleteLink);

    include_once __DIR__.'/../../../fns/create_panel.php';
    return create_panel('File Options', $content);

}
