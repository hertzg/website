<?php

function create_options_panel ($user, $id_folders, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    $options = [];

    include_once "$fnsDir/Page/imageArrowLink.php";

    $href = "{$base}new-folder/";
    if ($id_folders) $href .= "?parent_id_folders=$id_folders";
    $options[] = Page\imageArrowLink('New Folder', $href, 'create-folder');

    $href = "{$base}upload-files/";
    if ($id_folders) $href .= "?id_folders=$id_folders";
    $options[] = Page\imageArrowLink('Upload Files', $href, 'upload');

    if ($id_folders) {

        $title = 'Rename This Folder';
        $href = "{$base}rename-folder/?id_folders=$id_folders";
        $options[] = Page\imageArrowLink($title, $href, 'rename');

        $title = 'Move This Folder';
        $href = "{$base}move-folder/?id_folders=$id_folders";
        $options[] = Page\imageArrowLink($title, $href, 'move-folder');

        $title = 'Send This Folder';
        $href = "{$base}send-folder/?id_folders=$id_folders";
        $options[] = Page\imageArrowLink($title, $href, 'send');

        $title = 'Delete This Folder';
        $href = "{$base}delete-folder/?id_folders=$id_folders";
        $options[] = Page\imageArrowLink($title, $href, 'trash-bin');

    } else {
        $num_received_files = $user->num_received_files;
        $num_received_folders = $user->num_received_folders;
        if ($num_received_files || $num_received_folders) {
            $n = $num_received_files + $num_received_folders;
            include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
            $title = 'Received Files';
            $description = "$n total.";
            $href = "{$base}received/";
            $options[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, 'mail');
        }
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
