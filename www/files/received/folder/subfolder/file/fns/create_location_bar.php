<?php

function create_location_bar ($mysqli, $file) {

    $fnsDir = __DIR__.'/../../../../../../fns';
    $id_users = $file->id_users;

    include_once "$fnsDir/ReceivedFolderSubfolders/getOnUser.php";
    $parentFolder = \ReceivedFolderSubfolders\getOnUser(
        $mysqli, $id_users, $file->parent_id);

    $links = [
        "<a class=\"tag\" href=\"../?id=$parentFolder->id#file_$file->id\">"
            .htmlspecialchars($parentFolder->name)
        .'</a>',
    ];

    $hash = "folder_$parentFolder->id";
    while ($parentFolder->parent_id) {
        $parentFolder = \ReceivedFolderSubfolders\getOnUser(
            $mysqli, $id_users, $parentFolder->parent_id);
        $links[] =
            "<a class=\"tag\" href=\"../?id=$parentFolder->id#$hash\">"
                .htmlspecialchars($parentFolder->name)
            .'</a>';
        $hash = "folder_$parentFolder->id";
    }

    $href = "../../?id=$parentFolder->id_received_folders#$hash";
    $links[] =
        "<a class=\"tag\" href=\"$href\">"
            .htmlspecialchars($file->received_folder_name)
        .'</a>';

    return
        '<div class="textAndButtons">'
            .'<span class="textAndButtons-text">Location:</span>'
            .'<span class="zeroSize"> </span>'
            .join('<span class="zeroSize"> </span>', array_reverse($links))
        .'</div>';

}
