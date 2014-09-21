<?php

function create_folder_options_panel ($id_folders) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "rename-folder/?id_folders=$id_folders";
    $renameLink = Page\imageArrowLink('Rename', $href, 'rename');

    $href = "move-folder/?id_folders=$id_folders";
    $moveLink = Page\imageArrowLink('Move', $href, 'move-folder');

    $href = "send-folder/?id_folders=$id_folders";
    $sendLink = Page\imageArrowLink('Send', $href, 'send');

    $href = "delete-folder/?id_folders=$id_folders";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageArrowLink('Delete', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $content =
        Page\staticTwoColumns($renameLink, $moveLink)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns($sendLink, $deleteLink);
    include_once "$fnsDir/create_panel.php";
    return create_panel('Folder Options', $content);

}
