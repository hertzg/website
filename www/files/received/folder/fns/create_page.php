<?php

function create_page ($mysqli, $receivedFolder, $base = '') {

    $id = $receivedFolder->id;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/ReceivedFolderFiles/indexOnParent.php";
    $files = ReceivedFolderFiles\indexOnParent($mysqli, $id, 0);

    include_once "$fnsDir/ReceivedFolderSubfolders/indexOnParent.php";
    $subfolders = ReceivedFolderSubfolders\indexOnParent($mysqli, $id, 0);

    $items = [];

    if ($files || $subfolders) {

        include_once "$fnsDir/Page/imageLink.php";

        foreach ($subfolders as $subfolder) {
            $item_id = $subfolder->id;
            $items[] = Page\imageLink(htmlspecialchars($subfolder->name),
                "{$base}subfolder/?id=$item_id", 'folder',
                ['id' => "folder_$item_id"]);
        }

        foreach ($files as $file) {
            $item_id = $file->id;
            $items[] = Page\imageLink(htmlspecialchars($file->name),
                "{$base}file/?id=$item_id", "$file->media_type-file",
                ['id' => "file_$item_id"]);
        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('Folder is empty');
    }

    include_once __DIR__.'/create_options_panel.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Received',
                'href' => "$base../#folder_$id",
            ],
        ],
        "Received Folder #$id",
        Page\sessionMessages('files/received/folder/messages')
        .Form\label('Received from',
            htmlspecialchars($receivedFolder->sender_username))
        .'<div class="hr"></div>'
        .Form\label('Folder name', htmlspecialchars($receivedFolder->name))
        .create_panel('The Folder', join('<div class="hr"></div>', $items))
        .create_options_panel($receivedFolder, $base)
    );

}
