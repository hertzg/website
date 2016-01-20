<?php

function create_page ($mysqli, $receivedFolder, &$scripts, $base = '') {

    $id = $receivedFolder->id;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', "$base../../../");

    include_once "$fnsDir/ReceivedFolderFiles/indexOnParent.php";
    $files = ReceivedFolderFiles\indexOnParent($mysqli, $id, 0);

    include_once "$fnsDir/ReceivedFolderSubfolders/indexOnParent.php";
    $subfolders = ReceivedFolderSubfolders\indexOnParent($mysqli, $id, 0);

    $items = [];

    if ($files || $subfolders) {

        if ($subfolders) {
            include_once "$fnsDir/Page/imageLink.php";
            foreach ($subfolders as $subfolder) {
                $item_id = $subfolder->id;
                $items[] = Page\imageLink(
                    htmlspecialchars($subfolder->name),
                    "{$base}subfolder/?id=$item_id", 'folder',
                    ['id' => "folder_$item_id"]);
            }
        }

        if ($files) {
            include_once "$fnsDir/Page/imageLinkWithDescription.php";
            foreach ($files as $file) {
                $item_id = $file->id;
                $items[] = Page\imageLinkWithDescription(
                    htmlspecialchars($file->name), $file->readable_size,
                    "{$base}file/?id=$item_id", "$file->media_type-file",
                    ['id' => "file_$item_id"]);
            }
        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('Folder is empty');
    }

    include_once "$fnsDir/export_date_ago.php";
    $date_ago = export_date_ago($receivedFolder->insert_time);

    include_once __DIR__.'/create_options_panel.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/create_received_from_item.php";
    include_once "$fnsDir/ItemList/Received/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        Page\create(
            [
                'title' => 'Files',
                'href' => ItemList\Received\listHref("$base../")."#folder_$id",
            ],
            "Received Folder #$id",
            Page\sessionMessages('files/received/folder/messages')
            .create_received_from_item($receivedFolder)
        )
        .create_panel(
            'The Folder',
            '<div class="textAndButtons">'
                .'<span class="textAndButtons-text">Location:</span>'
                .'<span class="zeroSize"> </span>'
                .'<span class="tag active">'
                    .htmlspecialchars($receivedFolder->name)
                .'</span>'
            .'</div>'
            .join('<div class="hr"></div>', $items)
            .Page\infoText("Folder received $date_ago.")

        )
        .create_options_panel($receivedFolder, $base);

}
