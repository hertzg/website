<?php

function create_options_panel ($idfolders, $base = '') {

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';

    if ($idfolders) {
        $newFolderHref = "{$base}new-folder/?parentidfolders=$idfolders";
        $uploadFilesHref = "{$base}upload-files/?idfolders=$idfolders";
    } else {
        $newFolderHref = "{$base}new-folder/";
        $uploadFilesHref = "{$base}upload-files/";
    }

    $options = [
        Page\imageArrowLink('New Folder', $newFolderHref, 'create-folder'),
        Page\imageArrowLink('Upload Files', $uploadFilesHref, 'upload'),
    ];

    if ($idfolders) {

        $title = 'Rename This Folder';
        $href = "{$base}rename-folder/?idfolders=$idfolders";
        $options[] = Page\imageArrowLink($title, $href, 'rename');

        $title = 'Move This Folder';
        $href = "{$base}move-folder/?idfolders=$idfolders";
        $options[] = Page\imageArrowLink($title, $href, 'move-folder');

        $title = 'Delete This Folder';
        $href = "{$base}delete-folder/?idfolders=$idfolders";
        $options[] = Page\imageArrowLink($title, $href, 'trash-bin');

    }

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
