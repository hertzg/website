<?php

function create_options_panel ($id_folders, $base = '') {

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';

    if ($id_folders) {
        $newFolderHref = "{$base}new-folder/?parent_id_folders=$id_folders";
        $uploadFilesHref = "{$base}upload-files/?id_folders=$id_folders";
    } else {
        $newFolderHref = "{$base}new-folder/";
        $uploadFilesHref = "{$base}upload-files/";
    }

    $options = [
        Page\imageArrowLink('New Folder', $newFolderHref, 'create-folder'),
        Page\imageArrowLink('Upload Files', $uploadFilesHref, 'upload'),
    ];

    if ($id_folders) {

        $title = 'Rename This Folder';
        $href = "{$base}rename-folder/?id_folders=$id_folders";
        $options[] = Page\imageArrowLink($title, $href, 'rename');

        $title = 'Move This Folder';
        $href = "{$base}move-folder/?id_folders=$id_folders";
        $options[] = Page\imageArrowLink($title, $href, 'move-folder');

        $title = 'Delete This Folder';
        $href = "{$base}delete-folder/?id_folders=$id_folders";
        $options[] = Page\imageArrowLink($title, $href, 'trash-bin');

    }

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
