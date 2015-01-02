<?php

function create_location_bar ($mysqli, $folder) {

    $parentLinks = [];
    $hash = "folder_$folder->id";

    $parent_id = $folder->parent_id;
    if ($parent_id) {
        $fnsDir = __DIR__.'/../../../../../fns';
        include_once "$fnsDir/ReceivedFolderSubfolders/getOnUser.php";
        while ($parent_id) {
            $parentFolder = \ReceivedFolderSubfolders\getOnUser(
                $mysqli, $folder->id_users, $parent_id);
            $parentLinks[] =
                "<a class=\"tag\" href=\"./?id=$parent_id#$hash\">"
                    .htmlspecialchars($parentFolder->name)
                .'</a>';
            $hash = "folder_$parent_id";
            $parent_id = $parentFolder->parent_id;
        }
    }

    $href = "../?id=$folder->id_received_folders#$hash";
    $parentLinks[] = "<a class=\"tag\" href=\"$href\">root</a>";

    return
        '<div class="greyBar textAndButtons">'
            .'<span class="textAndButtons-text">Location:</span>'
            .join('', array_reverse($parentLinks))
            .'<span class="tag active">'
                .htmlspecialchars($folder->name)
            .'</span>'
        .'</div>';

}
