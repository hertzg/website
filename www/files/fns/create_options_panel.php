<?php

function create_options_panel ($user, $id_folders, $files, $base) {

    $previewableFiles = array_filter($files, function ($file) {
        $media_type = $file->media_type;
        return $media_type == 'audio' || $media_type == 'image' ||
            $media_type == 'video';
    });

    $fnsDir = __DIR__.'/../../fns';

    $options = [];

    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/twoColumns.php";

    if ($id_folders) $parentQuery = "?parent_id=$id_folders";
    else $parentQuery = '';

    $newFolderLink = Page\imageArrowLink(
        'New Folder', "{$base}new-folder/$parentQuery",
        'create-folder', ['id' => 'new-folder']);

    $uploadLink = Page\imageArrowLink(
        'Upload Files', "{$base}upload-files/$parentQuery",
        'upload', ['id' => 'upload-files']);

    if ($previewableFiles) {

        $slideshowLink = Page\imageArrowLink(
            'Sldieshow', "{$base}slideshow/$parentQuery",
            'slideshow', ['id' => 'slideshow']);

        $options[] = Page\twoColumns($slideshowLink, $newFolderLink);

        $options[] = $uploadLink;

    } else {
        $options[] = Page\twoColumns($newFolderLink, $uploadLink);
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
