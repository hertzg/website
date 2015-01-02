<?php

function create_location_bar ($mysqli, $folder) {

    $parentLinks = [];

    if ($folder) {

        $parentLinks[] =
            '<span class="tag active">'
                .htmlspecialchars($folder->name)
            .'</span>';

        $hash = "folder_$folder->id_folders";
        $parent_id_folders = $folder->parent_id_folders;
        if ($parent_id_folders) {
            include_once __DIR__.'/../../fns/Folders/get.php';
            while ($parent_id_folders) {
                $parentFolder = \Folders\get($mysqli,
                    $folder->id_users, $parent_id_folders);
                $href = "./?id_folders=$parent_id_folders#$hash";
                $parentLinks[] =
                    "<a class=\"tag\" href=\"$href\">"
                        .htmlspecialchars($parentFolder->name)
                    .'</a>';
                $hash = "folder_$parent_id_folders";
                $parent_id_folders = $parentFolder->parent_id_folders;
            }
        }

        $parentLinks[] = "<a class=\"tag\" href=\"./#$hash\">root</a>";


    } else {
        $parentLinks[] = '<span class="tag active">root</span>';
    }

    return
        '<div class="greyBar textAndButtons">'
            .'<span class="textAndButtons-text">Location:</span>'
            .join('', array_reverse($parentLinks))
        .'</div>';

}
