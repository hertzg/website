<?php

function create_options_panel ($file) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/imageLink.php";

    $id = $file->id_files;
    $id_folders = $file->id_folders;

    $href = "../slideshow/?id=$id";
    if ($id_folders) $href .= "&amp;parent_id_folders=$id_folders";
    $slideshowLink = Page\imageLink('Slideshow', $href, 'slideshow');

    $href = "../download-file/?id=$id";
    $downloadLink = Page\imageLink('Download', $href, 'download');

    $href = "../rename-file/?id=$id";
    $renameLink = Page\imageArrowLink('Rename', $href, 'rename');

    $href = "../move-file/?id=$id";
    if ($id_folders) $href .= "&amp;id_folders=$file->id_folders";
    $moveLink = Page\imageArrowLink('Move', $href, 'move-file');

    $href = "../send-file/?id=$id";
    $sendLink = Page\imageArrowLink('Send', $href, 'send');

    $href = "../delete-file/?id=$id";
    $deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $content =
        Page\staticTwoColumns($slideshowLink, $downloadLink)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns($renameLink, $moveLink)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns($sendLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('File Options', $content);

}
