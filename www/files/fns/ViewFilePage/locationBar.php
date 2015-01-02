<?php

namespace ViewFilePage;

function locationBar ($mysqli, $file) {

    $parentLinks = [];
    $hash = "file_$file->id_files";

    $parent_id_folders = $file->id_folders;
    if ($parent_id_folders) {
        include_once __DIR__.'/../../../fns/Folders/get.php';
        while ($parent_id_folders) {
            $parentFolder = \Folders\get($mysqli,
                $file->id_users, $parent_id_folders);
            $parentLinks[] =
                "<a class=\"tag\" href=\"../?id_folders=$parent_id_folders#$hash\">"
                    .htmlspecialchars($parentFolder->name)
                .'</a>';
            $hash = "folder_$parent_id_folders";
            $parent_id_folders = $parentFolder->parent_id_folders;
        }
    }

    $parentLinks[] = "<a class=\"tag\" href=\"../#$hash\">root</a>";

    return
        '<div class="greyBar textAndButtons">'
            .'<span class="textAndButtons-text">Location:</span>'
            .join('', array_reverse($parentLinks))
        .'</div>';

}
