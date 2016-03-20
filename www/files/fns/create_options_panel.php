<?php

function create_options_panel ($user, $id_folders, $files, $base) {

    $previewableFiles = array_filter($files, function ($file) {
        $media_type = $file->media_type;
        return $media_type == 'audio' || $media_type == 'image' ||
            $media_type == 'video';
    });

    $fnsDir = __DIR__.'/../../fns';

    if ($id_folders) $parentQuery = "?parent_id=$id_folders";
    else $parentQuery = '';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $newFolderLink = Page\imageArrowLink(
        'New Folder', "{$base}new-folder/$parentQuery",
        'create-folder', ['id' => 'new-folder']);

    $uploadLink = Page\imageArrowLink(
        'Upload Files', "{$base}upload-files/$parentQuery",
        'upload', ['id' => 'upload-files']);

    if ($previewableFiles) {
        $content =
            Page\imageArrowLink('Sldieshow', "{$base}slideshow/$parentQuery",
                'slideshow', ['id' => 'slideshow'])
            .'<div class="hr"></div>';
    } else {
        $content = '';
    }

    include_once "$fnsDir/Page/twoColumns.php";
    $content .= Page\twoColumns($newFolderLink, $uploadLink);

    include_once "$fnsDir/Page/panel.php";
    return Page\panel('Options', $content);

}
