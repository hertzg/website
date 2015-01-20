<?php

function create_move_location_bar ($mysqli,
    $id, $folder, $item_id, $folder_id) {

    $parentLinks = [];

    if ($folder) {

        $parentLinks[] =
            '<span class="tag active">'
                .htmlspecialchars($folder->name)
            .'</span>';

        $hash = $folder->id_folders;
        $parent_id_folders = $folder->parent_id_folders;
        if ($parent_id_folders) {
            include_once __DIR__.'/../../fns/Folders/getOnUser.php';
            while ($parent_id_folders) {
                $parentFolder = \Folders\getOnUser($mysqli,
                    $folder->id_users, $parent_id_folders);
                $href = "./?$item_id=$id&amp;"
                    ."$folder_id=$parentFolder->id_folders";
                $parentLinks[] =
                    "<a class=\"tag\" href=\"$href#$hash\">"
                        .htmlspecialchars($parentFolder->name)
                    .'</a>';
                $hash = $parent_id_folders;
                $parent_id_folders = $parentFolder->parent_id_folders;
            }
        }

        $href = "./?$item_id=$id#$hash";
        $parentLinks[] = "<a class=\"tag\" href=\"$href\">root</a>";

    } else {
        $parentLinks[] = '<span class="tag active">root</span>';
    }

    return
        '<div class="greyBar textAndButtons">'
            .'<span class="textAndButtons-text">Location:</span>'
            .join('', array_reverse($parentLinks))
        .'</div>';

}
