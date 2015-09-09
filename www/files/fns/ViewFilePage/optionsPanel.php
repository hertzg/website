<?php

namespace ViewFilePage;

function optionsPanel ($file) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/imageLink.php";

    $id = $file->id_files;
    $id_folders = $file->id_folders;

    $href = "../slideshow/?id=$id";
    if ($id_folders) $href .= "&amp;parent_id=$id_folders";
    $slideshowLink = \Page\imageArrowLink('Slideshow', $href, 'slideshow');

    $namePart = $file->name;
    if ($namePart === '..') $namePart = '_.';
    $namePart = rawurlencode(str_replace('/', '_', $namePart));
    $downloadLink = \Page\imageLink('Download',
        "../download-file/$id/$namePart?$file->content_revision", 'download');

    $renameLink = \Page\imageArrowLink('Rename',
        "../rename-file/?id=$id", 'rename', ['id' => 'rename']);

    $href = "../move-file/?id=$id";
    if ($id_folders) $href .= "&amp;id_folders=$file->id_folders";
    $moveLink = \Page\imageArrowLink('Move',
        $href, 'move-file', ['id' => 'move']);

    $sendLink = \Page\imageArrowLink('Send',
        "../send-file/?id=$id", 'send', ['id' => 'send']);

    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete', "../delete-file/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";

    $media_type = $file->media_type;
    if ($media_type == 'audio' || $media_type == 'image' ||
        $media_type == 'video') {

        $content =
            \Page\staticTwoColumns($slideshowLink, $downloadLink)
            .'<div class="hr"></div>'
            .\Page\staticTwoColumns($renameLink, $moveLink)
            .'<div class="hr"></div>'
            .\Page\staticTwoColumns($sendLink, $deleteLink);

    } else {
        $content =
            \Page\staticTwoColumns($downloadLink, $renameLink)
            .'<div class="hr"></div>'
            .\Page\staticTwoColumns($moveLink, $sendLink)
            .'<div class="hr"></div>'
            .$deleteLink;
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('File Options', $content);

}
