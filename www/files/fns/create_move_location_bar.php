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
        $parent_id = $folder->parent_id;
        if ($parent_id) {
            include_once __DIR__.'/../../fns/Folders/getOnUser.php';
            while ($parent_id) {
                $parentFolder = \Folders\getOnUser($mysqli,
                    $folder->id_users, $parent_id);
                $href = "./?$item_id=$id&amp;"
                    ."$folder_id=$parentFolder->id_folders";
                $parentLinks[] =
                    "<a class=\"tag\" href=\"$href#$hash\">"
                        .htmlspecialchars($parentFolder->name)
                    .'</a>';
                $hash = $parent_id;
                $parent_id = $parentFolder->parent_id;
            }
        }

        $href = "./?$item_id=$id#$hash";
        $parentLinks[] = "<a class=\"tag\" href=\"$href\">root</a>";

    } else {
        $parentLinks[] = '<span class="tag active">root</span>';
    }

    return
        '<div class="textAndButtons">'
            .'<span class="textAndButtons-text">Location:</span>'
            .join('', array_reverse($parentLinks))
        .'</div>';

}
