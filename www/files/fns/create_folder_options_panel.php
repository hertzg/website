<?php

function create_folder_options_panel ($id_folders, $base) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $renameLink = Page\imageArrowLink('Rename',
        "{$base}rename-folder/?id_folders=$id_folders",
        'rename', ['id' => 'rename']);

    $moveLink = Page\imageArrowLink('Move',
        "{$base}move-folder/?id_folders=$id_folders",
        'move-folder', ['id' => 'move']);

    $sendLink = Page\imageArrowLink('Send',
        "{$base}send-folder/?id_folders=$id_folders",
        'send', ['id' => 'send']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink = Page\imageLink('Delete',
        "{$base}delete-folder/?id_folders=$id_folders",
        'trash-bin', ['id' => 'delete']);

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $content =
        Page\staticTwoColumns($renameLink, $moveLink)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns($sendLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Folder Options', $content);

}
