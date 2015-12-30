<?php

function create_location_bar ($mysqli, $folder) {

    if ($folder) {

        $links[] =
            '<span class="tag active">'
                .htmlspecialchars($folder->name)
            .'</span>';

        $hash = "folder_$folder->id_folders";
        $parent_id = $folder->parent_id;
        if ($parent_id) {
            include_once __DIR__.'/../../fns/Folders/getOnUser.php';
            while ($parent_id) {
                $parentFolder = \Folders\getOnUser($mysqli,
                    $folder->id_users, $parent_id);
                $href = "./?id_folders=$parent_id#$hash";
                $links[] =
                    "<a class=\"tag\" href=\"$href\">"
                        .htmlspecialchars($parentFolder->name)
                    .'</a>';
                $hash = "folder_$parent_id";
                $parent_id = $parentFolder->parent_id;
            }
        }

        $links[] = "<a class=\"tag\" href=\"./#$hash\">root</a>";

    } else {
        $links[] = '<span class="tag active">root</span>';
    }

    return
        '<div class="textAndButtons">'
            .'<span class="textAndButtons-text">Location:</span>'
            .'<span class="zeroSize"> </span>'
            .join('<span class="zeroSize"> </span>', array_reverse($links))
        .'</div>';

}
