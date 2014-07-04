<?php

function create_options_panel ($user, $id_folders) {

    $fnsDir = __DIR__.'/../../fns';

    $options = [];

    include_once "$fnsDir/Page/imageArrowLink.php";

    if ($id_folders) $parentQuery = "?parent_id_folders=$id_folders";
    else $parentQuery = '';

    $href = "new-folder/$parentQuery";
    $options[] = Page\imageArrowLink('New Folder', $href, 'create-folder');

    $href = "upload-files/$parentQuery";
    $options[] = Page\imageArrowLink('Upload Files', $href, 'upload');

    if ($id_folders) {

        $title = 'Rename This Folder';
        $href = "rename-folder/?id_folders=$id_folders";
        $options[] = Page\imageArrowLink($title, $href, 'rename');

        $title = 'Move This Folder';
        $href = "move-folder/?id_folders=$id_folders";
        $options[] = Page\imageArrowLink($title, $href, 'move-folder');

        $title = 'Send This Folder';
        $href = "send-folder/?id_folders=$id_folders";
        $options[] = Page\imageArrowLink($title, $href, 'send');

        $title = 'Delete This Folder';
        $href = "delete-folder/?id_folders=$id_folders";
        $options[] = Page\imageArrowLink($title, $href, 'trash-bin');

    } else {
        $num_received_files = $user->num_received_files;
        $num_received_folders = $user->num_received_folders;
        if ($num_received_files || $num_received_folders) {
            $n = $num_received_files + $num_received_folders;
            include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
            $title = 'Received Files';
            $description = "$n total.";
            $href = 'received/';
            $options[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, 'mail');
        }
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
