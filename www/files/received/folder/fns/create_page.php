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
            include_once "$fnsDir/Page/imageArrowLink.php";
            foreach ($subfolders as $subfolder) {
                $item_id = $subfolder->id;
                $items[] = Page\imageArrowLink(
                    htmlspecialchars($subfolder->name),
                    "{$base}subfolder/?id=$item_id", 'folder',
                    ['id' => "folder_$item_id"]);
            }
        }

        if ($files) {
            include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
            foreach ($files as $file) {
                $item_id = $file->id;
                $items[] = Page\imageArrowLinkWithDescription(
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
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/infoText.php";
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
        .create_panel(
            'The Folder',
            '<div class="greyBar textAndButtons">'
                .'<span class="textAndButtons-text">Location:</span>'
                .'<span class="tag active">'
                    .htmlspecialchars($receivedFolder->name)
                .'</span>'
            .'</div>'
            .join('<div class="hr"></div>', $items)
            .Page\infoText("Folder received $date_ago.")

        )
        .create_options_panel($receivedFolder, $base)
    );

}
