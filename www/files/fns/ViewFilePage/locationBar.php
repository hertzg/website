<?php

namespace ViewFilePage;

function locationBar ($mysqli, $file) {

    $parentLinks = [];
    $hash = "file_$file->id_files";

    $parent_id = $file->id_folders;
    if ($parent_id) {
        include_once __DIR__.'/../../../fns/Folders/getOnUser.php';
        while ($parent_id) {
            $parentFolder = \Folders\getOnUser($mysqli,
                $file->id_users, $parent_id);
            $href = "../?id_folders=$parent_id#$hash";
            $parentLinks[] =
                "<a class=\"tag\" href=\"$href\">"
                    .htmlspecialchars($parentFolder->name)
                .'</a>';
            $hash = "folder_$parent_id";
            $parent_id = $parentFolder->parent_id;
        }
    }

    $parentLinks[] = "<a class=\"tag\" href=\"../#$hash\">root</a>";

    return
        '<div class="textAndButtons">'
            .'<span class="textAndButtons-text">Location:</span>'
            .join('', array_reverse($parentLinks))
        .'</div>';

}
