<?php

function create_options_panel ($user, $id_folders, $files) {

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

    $newFolderLink = Page\imageArrowLink('New Folder',
        "new-folder/$parentQuery", 'create-folder', ['id' => 'new-folder']);

    $uploadLink = Page\imageArrowLink('Upload Files',
        "upload-files/$parentQuery", 'upload', ['id' => 'upload-files']);

    if ($previewableFiles) {

        $slideshowLink = Page\imageArrowLink('Sldieshow',
            "slideshow/$parentQuery", 'slideshow', ['id' => 'slideshow']);

        $options[] = Page\twoColumns($slideshowLink, $newFolderLink);

        $options[] = $uploadLink;

    } else {
        $options[] = Page\twoColumns($newFolderLink, $uploadLink);
    }

    if (!$id_folders) {
        $num_received_files = $user->num_received_files;
        $num_received_folders = $user->num_received_folders;
        if ($num_received_files || $num_received_folders) {
            $n = $num_received_files + $num_received_folders;
            include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
            $options[] = Page\imageArrowLinkWithDescription('Received Files',
                "$n total.", 'received/', 'receive', ['id' => 'received']);
        }
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
