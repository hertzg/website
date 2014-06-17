<?php

function create_options_panel ($file) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/imageLink.php";

    $id = $file->id_files;

    $href = "../download-file/?id=$id";
    $downloadLink = Page\imageLink('Download', $href, 'download');

    $href = "../rename-file/?id=$id";
    $renameLink = Page\imageArrowLink('Rename', $href, 'rename');

    $href = "../move-file/?id=$id&id_folders=$file->id_folders";
    $moveLink = Page\imageArrowLink('Move', $href, 'move-file');

    $href = "../send-file/?id=$id";
    $sendLink = Page\imageArrowLink('Send', $href, 'send');

    $href = "../delete-file/?id=$id";
    $deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $content =
        Page\staticTwoColumns($downloadLink, $renameLink)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns($moveLink, $sendLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    include_once "$fnsDir/create_panel.php";
    return create_panel('File Options', $content);

}
